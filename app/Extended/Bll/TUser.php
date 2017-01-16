<?php


namespace App\Extended\Bll;

use App\Extended\Bll\Base\BllBase;
use App\Extended\Common\StringHelper;
use App\Extended\Common\Exception\CheckDataException;
use App\Extended\Dal\Base\DalBase;
use App\Extended\Model\Base\ModelBase;
use Illuminate\Support\Facades\Mail;

class TUser extends BllBase
{
    private $bllTQuestion;
    private $bllTQuestionTable;
    private $bllTLog;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TUser ());
        $this->bllTQuestion = new \App\Extended\Bll\TQuestion();
        $this->bllTQuestionTable = new \App\Extended\Bll\TQuestionTable();
        $this->bllTLog = new \App\Extended\Bll\TLog();
    }

    public function Add(ModelBase $model)
    {
        $model->f_password_key = StringHelper::Random(16);
        $this->Check($model); // 检验数据
        //密码加密
        $model->f_login_password = StringHelper::Encrypt($model->f_login_password, $model->f_password_key);
        return parent::Add($model);
    }

    public function Update(ModelBase $model)
    {
        $this->Check($model); // 检验数据
        return parent::Update($model);
    }

    public function GetModel($id)
    {
        $model = parent::GetModel($id);
        //密码解码
        if ($model != null)
            $model->f_login_password = StringHelper::Decrypt($model->f_login_password, $model->f_password_key);
        return $model;
    }

    public function GetModelByLoginName($f_login_name)
    {
        $model = $this->dal->GetModelByLoginName($f_login_name);
        //密码解码
        if ($model != null)
            $model->f_login_password = StringHelper::Decrypt($model->f_login_password, $model->f_password_key);
        return $model;
    }

    /**
     * 登录
     * @param $f_login_name 账号
     * @param $f_login_password MD5(账号+密码)
     * @return mixed
     * @throws CheckDataException
     */
    public function Login($f_login_name, $f_login_password)
    {
        if (StringHelper::IsEmpty($f_login_name))
            throw new CheckDataException ('请输入账号');
        //添加用户信息
        $user = $this->GetModelByLoginName($f_login_name);
        if ($user == null)
            throw new CheckDataException ('用户不存在');
        if (StringHelper::MD5($user->f_login_name . $user->f_login_password) != $f_login_password)
            throw new CheckDataException ('密码有误');
        return $user;
    }

    /**
     * 注册
     * @param $f_login_name 账号
     * @param $f_login_password 密码
     * @param $f_mail 邮箱地址
     * @param $f_show_name 昵称
     * @param $f_mail_key 验证码
     * @return mixed
     * @throws CheckDataException
     * @throws Exception
     */
    public function Register($f_login_name, $f_login_password, $f_mail, $f_show_name, $f_mail_key)
    {
        if (StringHelper::IsEmpty($f_mail))
            throw new CheckDataException ('请输入邮箱地址');

        if (!StringHelper::IsMail($f_mail))
            throw new CheckDataException ('邮箱地址格式有误');
        //验证信息
        $questionTableOld = $this->bllTQuestionTable->GetModelByMail($f_mail, null);
        if ($questionTableOld == null) {
            throw new CheckDataException ("验证码有误！");
        } elseif ($questionTableOld != null && $questionTableOld->f_validation == 0) {
            $question = $this->bllTQuestion->GetModel($questionTableOld->f_question_id);
            if ($question->f_answer != $f_mail_key)
                throw new CheckDataException ("验证码有误！");
        } elseif ($questionTableOld != null && $questionTableOld->f_validation == 1) {
            throw new CheckDataException ("邮箱地址已注册！");
        }
        if (StringHelper::IsEmpty($f_login_name)) {
            $f_login_name = $f_mail;
        }
        try {
            //事务开始
            DalBase::TransactionBegin();
            //添加用户信息
            $user = new \App\Extended\Model\TUser();
            $user->f_id = GUIDHelper::CreateGUID();
            $user->f_login_name = $f_login_name;
            $user->f_login_password = $f_login_password;
            $user->f_mail = $f_mail;
            $user->f_show_name = $f_show_name;
            $this->Add($user);
            //更新验证信息
            $questionTableOld->f_validation = 1;
            $this->bllTQuestionTable->Update($questionTableOld);
            //事务提交
            DalBase::TransactionCommit();
        } catch (Exception $e) {
            //事务回滚
            DalBase::TransactionRollBack();
            $this->bllTLog->LogException($e);//记录日志
            throw $e;
        }
    }

    /**
     * 发送注册邮件
     * @param $mailTo 收件地址
     * @return mixed
     * @throws CheckDataException
     * @throws Exception
     */
    public function RegisterMail($mailTo)
    {
        if (StringHelper::IsEmpty($mailTo)) {
            throw new CheckDataException ("请输入邮箱地址！");
        }
        if (!StringHelper::IsMail($mailTo)) {
            throw new CheckDataException ("邮箱地址格式有误！");
        }
        //删除旧验证信息
        $questionTableOld = $this->bllTQuestionTable->GetModelByMail($mailTo, null);
        if ($questionTableOld != null && $questionTableOld->f_validation == 1) {
            throw new CheckDataException ("邮箱地址已注册！");
        }
        // return $mailTo;
        $question = $this->bllTQuestion->GetModelRand();
        $data = [
            'mailTo' => $mailTo,
            'question' => $question
        ];

        Mail::send('emails.Register', $data, function ($message) use ($data) {
            $message->from('tianfuwang1@sina.com', '我要举报网');
            $message->to($data ['mailTo'])->subject('我要举报网 - 邮箱验证');
            // $message->attach($pathToFile);
        });
        try {
            //事务开始
            DalBase::TransactionBegin();
            if ($questionTableOld != null && $questionTableOld->f_validation == 0) {
                $questionTableOld->delete();
            }
            //记录验证信息
            $questionTable = new \App\Extended\Model\TQuestionTable();
            $questionTable->f_id = GUIDHelper::CreateGUID();
            $questionTable->f_question_id = $question->f_id;
            $questionTable->f_mail = $mailTo;
            $questionTable->f_validation = 0;
            $this->bllTQuestionTable->Add($questionTable);
            //事务提交
            DalBase::TransactionCommit();
        } catch (Exception $e) {
            //事务回滚
            DalBase::TransactionRollBack();
            $this->bllTLog->LogException($e);//记录日志
            throw $e;
        }
    }

    /**
     * 检验数据
     * @param ModelBase $model
     * @throws CheckDataException
     */
    public function Check(ModelBase $model)
    {
        if (StringHelper::IsEmpty($model->f_id))
            throw new CheckDataException ('id不能为空');

        if (StringHelper::IsEmpty($model->f_login_name))
            throw new CheckDataException ('请输入账号');

        if (StringHelper::CheckStrLenMin($model->f_login_name, 3) == false)
            throw new CheckDataException ('账号长度必须多于3位');

        if (StringHelper::IsEmpty($model->f_login_password))
            throw new CheckDataException ('请输入密码');

        if (StringHelper::CheckStrLen($model->f_login_password, 6, 15) == false)
            throw new CheckDataException ('密码长度必须为6-15位');

        if (StringHelper::IsEmpty($model->f_password_key))
            throw new CheckDataException ('数据有问题，请联系管理员修复');

        if (StringHelper::IsEmpty($model->f_mail))
            throw new CheckDataException ('请输入邮箱地址');

        if (!StringHelper::IsMail($model->f_mail))
            throw new CheckDataException ('邮箱地址格式有误');

        if (StringHelper::IsEmpty($model->f_show_name))
            throw new CheckDataException ('请输入昵称');

        if (StringHelper::CheckStrLen($model->f_show_name, 2, 10) == false)
            throw new CheckDataException ('昵称长度必须为2-10位');
    }
}
