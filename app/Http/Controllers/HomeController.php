<?php namespace App\Http\Controllers;


use App\Extended\Common\Exception\CheckDataException;
use App\Extended\Common\GUIDHelper;
use App\Extended\Common\StringHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends RoutesController
{
    private $bllTQuestion;
    private $bllTQuestionTable;
    private $bllTUser;
    /*
     * |--------------------------------------------------------------------------
     * | Home Controller
     * |--------------------------------------------------------------------------
     * |
     * | This controller renders your application's "dashboard" for users that
     * | are authenticated. Of course, you are free to change or remove the
     * | controller as you wish. It is just here to get your app started!
     * |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->bllTQuestion = new \App\Extended\Bll\TQuestion();
        $this->bllTQuestionTable = new \App\Extended\Bll\TQuestionTable();
        $this->bllTUser = new \App\Extended\Bll\TUser();
    }

    /**
     * 主页
     *
     */
    public function Index()
    {
//        var_dump($_COOKIE);
//        phpinfo();

//        $question = new \App\Extended\Model\TQuestion ();
//        $question->f_id = GUIDHelper::CreateGUID();
//        $question->f_question = "1+2=";
//        $question->f_answer = "3";
//        $this->bllTQuestion->Add($question);
        $question = $this->bllTQuestion->GetModelRand();
        return view('Home.Index', ['question' => $question, 'isLogin' => Session::has('LoginUser')]);
    }

    /**
     * 新主页
     *
     * @return Response
     */
    public function IndexNew()
    {
        return view('Home.IndexNew');
    }

    /**
     * 登录
     *
     * @return Response
     */
    public function Login()
    {
        return view('Home.Login');
    }

    /**
     * 注销
     *
     * @return Response
     */
    public function LoginOut()
    {
        Session::put('LoginUser', null);
        return Redirect::to('/');
    }

    /**
     * 登录用户
     *
     * @param Request $request
     * @return Response
     */
    public function LoginSubmit_Post(Request $request)
    {
        $retmsg = "";
        try {
            $f_login_name = $request->input('f_login_name');
            $f_login_password = $request->input('f_login_password');
            $user = $this->bllTUser->Login($f_login_name, $f_login_password);//登录
            Session::put('LoginUser', $user);
        } catch (CheckDataException $e) {
            //验证提示
            $retmsg = $e->getMessage();
        } catch (Exception $e) {
            $retmsg = "异常：" . $e->getMessage();
        }
        return $retmsg;
    }

    /**
     * 注册
     *
     * @return Response
     */
    public function Register()
    {
        return view('Home.Register');
    }

    /**
     * 注册添加用户
     *
     * @param Request $request
     * @return Response
     */
    public function RegisterSubmit_Post(Request $request)
    {
        $retmsg = "";
        try {
            $f_login_name = $request->input('f_login_name');
            $f_login_password = $request->input('f_login_password');
            $f_mail = $request->input('f_mail');
            $f_show_name = $request->input('f_show_name');
            $f_mail_key = $request->input('f_mail_key');
            $this->bllTUser->Register($f_login_name, $f_login_password, $f_mail, $f_show_name, $f_mail_key);//注册
        } catch (CheckDataException $e) {
            //验证提示
            $retmsg = $e->getMessage();
        } catch (Exception $e) {
            $retmsg = "异常：" . $e->getMessage();
        }
        return $retmsg;
    }

    /**
     * 注册邮件
     *
     * @param Request $request
     * @return Response
     */
    public function RegisterMail_Post(Request $request)
    {
        $retmsg = "";
        try {
            $mailTo = $request->input('mailTo');
            $this->bllTUser->RegisterMail($mailTo);//发送邮件
        } catch (CheckDataException $e) {
            //验证提示
            $retmsg = $e->getMessage();
        } catch (Exception $e) {
            $retmsg = "异常：" . $e->getMessage();
        }
        return $retmsg;
    }

    /**
     * 注册成功
     *
     * @return Response
     */
    public function RegisterSuccess()
    {
        return view('Home.RegisterSuccess');
    }

    /**
     * 信息管理
     *
     * @return Response
     */
    public function UserInfo()
    {
        if (Session::has('LoginUser')) {
            return view('Home.UserInfo');
        } else {
            return view('Home.Login');
        }
    }

    /**
     * 信息管理
     *
     * @return Response
     */
    public function PhpInfo()
    {
        phpinfo();
    }
}
