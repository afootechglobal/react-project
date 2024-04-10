import { React } from "react";

function ResetPassword({closeSignUp}) {

  return (
    <>
  
      <div className="overlay-off-div animated fadeIn" id="overlay-close" onClick={(e) => {e.target.id === "overlay-close" && closeSignUp();}}>
        <div className="slide-back-div">
            <div className="header-top"><h2>RESET PASSWORD</h2> <button className="close-btn" onClick={() => closeSignUp()} ><i className="bi-x-lg"></i></button></div>
            <div className="slide-in ">
                <div className="fill-form-div container-div animated fadeIn">
                    <div className="alert alert-success"><i className="bi-person"></i> Dear <span id="username"></span>, an <span>OTP</span> has been sent to your email address (<span id="useremail"></span>) to reset your password. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.</div>
                   
                    <div className="title-div"> ENTER OTP: <span>*</span> <div id="otp_info"><span>OTP not accepted!</span></div></div>
                    <input id="reset_password_otp" type="tel" className="text-field" onkeypress="isNumber_Check()" placeholder="ENTER OTP" title="Enter OTP"/>

                    <div className="alert sign-up-alert"><span>OTP</span> not received? <span id="resend" onclick="_resend_otp('resend','<?php echo $user_id?>')"><i className="bi-send"></i> RESEND OTP</span></div>

                    <div className="title-div"> CREATE PASSWORD: <span>*</span></div>
                    <div className="password-container">
                        <input  type="password" id="create_reset_password" onkeyup="_show_password_visibility('create_reset_password','toggle_create_reset_password')" className="text-field" placeholder="CREATE PASSWORD" title="CREATE PASSWORD"  />
                        <div id="toggle_create_reset_password"  onclick="_togglePasswordVisibility('create_reset_password','toggle_create_reset_password')">
                            <i className="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>
                    <div className="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>

                    <div className="title-div"> COMFIRMED PASSWORD: <span>*</span> <span id="message">Password Not Matched!</span></div>
                    <div className="password-container">
                        <input type="password" id="confirmed_reset_password" onkeyup="_check_password_match('create_reset_password','confirmed_reset_password','toggle_confirmed_reset_password')" className="text-field" placeholder="COMFIRMED PASSWORD" title="COMFIRMED PASSWORD" />
                        <div id="toggle_confirmed_reset_password" onclick="_togglePasswordVisibility('confirmed_reset_password','toggle_confirmed_reset_password')">
                            <i className="bi-eye-slash password-toggle"></i>
                        </div>
                    </div> 
                    <button className="btn" type="button"  title-div="Reset" id="comfirmed_reset_btn" onclick="_comfirmed_reset_password('<?php echo $user_id?>')"><i className="bi-check"></i> Reset Password </button>
                </div>

                
            </div>
        </div>
    </div>  

    </>

  )
  }


export default ResetPassword;