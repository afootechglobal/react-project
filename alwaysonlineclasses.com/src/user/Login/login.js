import { React, useState, useEffect } from "react";

import axios from 'axios';
import {GetLoginApi} from './ApiFunction';
import ShowAlert from './alert';
import ResetPassword from './ResetPassword';
import SignUp from './SignUp';
import logo from './all-images/images/logo.png';


 const Login = () => {

///// toggleForm useSate paramenters
  const [isLoginFormVisible, setIsLoginFormVisible] = useState(true);
  const toggleForms = () => {
    setIsLoginFormVisible(!isLoginFormVisible);
  };


  const alertClose = () => {
    setShowAlert(false);
  };

  ///// PopUp useSate paramenters
  const [resetPassPopUp, setresetPassPopUp] = useState(false);
  const [signUpPopUp, setSignUpPopUp] = useState(false);

 
  const getLogin = () => {
      const {successMessage, showAlert, setShowAlert, loginData,setLoginData, isLoading} = GetLoginApi('login_api');
  };






//   const proceedResetPassword = async () => {
//     setIsLoading(true);
//     const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
//     const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;

//     const { fullname, email, mobile } = getUserProfile;

//     if (!fullname) {
//         setSuccessMessage({
//             message1: 'FULLNAME ERROR!',
//             message2: 'Fill this fields to continue',
//             result: true,
//             onClose: { alertClose },
//         });
//         setShowAlert(getUserProfile);
//         setIsLoading(false);
//         return;
//     } else if (!email) {
//         setSuccessMessage({
//             message1: 'EMAIL ERROR!',
//             message2: 'Fill this fields to continue',
//             result: true,
//             onClose: { alertClose },
//         });
//         setShowAlert(getUserProfile);
//         setIsLoading(false);
//         return;
//     } else if (!isValidEmail(email)) {
//         setSuccessMessage({
//             message1: 'EMAIL ERROR!',
//             message2: 'Invalid email address',
//             result: true,
//             onClose: { alertClose },
//         });

//         setShowAlert(getUserProfile);
//         setIsLoading(false);
//         return;

//     } else if (!isValidPhoneNumber(mobile)) {
//         setSuccessMessage({
//             message1: 'PHONE NUMBER ERROR!',
//             message2: 'IInvalid phone number',
//             result: true,
//             onClose: { alertClose },
//         });
//         setShowAlert(getUserProfile);
//         setIsLoading(false);
//         return;
//     } else {

//         const endPoint = {
//             action: 'update_user_api',
//             fullname,
//             email,
//             mobile,
//         };
//         try {
//             const endpoint = await axios.post(apiUrl, endPoint);
//             const responseData = endpoint.data;
//             const result = responseData.result;

//             if (result === true) {
//                 setSuccessMessage(responseData);
//                 setShowAlert(responseData);
//                 setgetUserProfile({
//                     // ...getUserProfile,
//                     fullname: responseData.data.fullname,
//                     email: responseData.data.email,
//                     mobile: responseData.data.mobile,
//                 });

//             } else {
//                 setSuccessMessage(responseData);
//                 setShowAlert(responseData);
//             }

//         } catch (error) {
//             console.error('Error:', error);
//         } finally {
//             setIsLoading(false);
//         }
//     };
//     // return {setgetUserProfile};
// }


  return (
    <>

      <section className="login-section">

        <div className="login-side-div"></div>

        <div className="div-in">
          <div className="side-in-div animated zoomIn">
            <div className="side-text">
              <div className="logo-div" onClick="window.location.reload();"><img src={logo} alt="" /></div>
              <h1>Welcome To Always Online Classes</h1>
              <p>Access high-quality education from anywhere, at any time. Explore a wide range of subjects and courses delivered through virtual platforms on SSCE, GCE, NABTEB.</p>
            </div>

            <div className="social-div">
              <div className="icon-div"><i className="bi-facebook"></i></div>
              <div className="icon-div"><i className="bi-instagram"></i></div>
              <div className="icon-div"><i className="bi-twitter"></i></div>
              <div className="icon-div"><i className="bi bi-linkedin"></i></div>
            </div>

            <div className="acute-angle"></div>
          </div>

          <div className="log-in-div">
            <div className="form-div animated fadeInRight">
              <div className="logo-div" onClick="window.location.reload();"><img src={logo} alt="" /></div>
              <br clear="all" />
              <ul className="form-header">
                <h1 id="page-title">{isLoginFormVisible ? 'Log-In' : 'Reset Password'}</h1>
              </ul>
              {isLoginFormVisible ? (
                <div className={`fill-form-div  fade-in visible`} id="view_login">

                  <div className="title-div"> EMAIL ADDRESS: <span>*</span></div>
                  {/* <input type="email" className="text-field" onChange={(e) => setEmail(e.target.value)} placeholder="ENTER YOUR EMAIL ADDRESS" /> */}
                  <input type="email" className="text-field"
                    value={loginData.email}
                    onChange={(e) => setLoginData({ ...loginData, email: e.target.value })}

                    placeholder="ENTER YOUR EMAIL ADDRESS" />

                  <div className="title-div"> PASSWORD: <span>*</span></div>
                  <div className="password-container">
                    {/* <input type="password" onChange={(e) => setPassword(e.target.value)} className="text-field" placeholder="ENTER YOUR PASSWORD" /><br /> */}
                    <input type="password"
                      value={loginData.password}
                      onChange={(e) => setLoginData({ ...loginData, password: e.target.value })}
                      className="text-field" placeholder="ENTER YOUR PASSWORD" /><br />
                    <div id="login_pass" onclick="_togglePasswordVisibility('password','login_pass')">
                      <i className="bi-eye-slash password-toggle"></i>
                    </div>
                  </div>
                  <span className="title-in"> <input type="checkbox" /> Keep me login</span>
                  <span className="title-in reset-password" id="reset" onClick={toggleForms}>Forgot Password? </span>

                  <button className="btn" type="button" id="login_btn" disabled={isLoading} onClick={getLogin}><i className="bi-check"></i> {isLoading ? 'Authenticating' : 'Log-In'}</button>

                  <div className="notification-div login-footer-div">
                    Don't have an account? <span className="footer-in" onClick={() => setSignUpPopUp(true)} >Sign-Up </span>
                  </div>
                </div>
              ) : (
                <div className={`fill-form-div animated fadeIn procced_reset_password_info  fade-in visible`} id="procced_reset_password_info">
                  <div className="alert alert-success">
                    Provide your <span>Email Address</span> to reset your password
                  </div>
                  <div className="title-div"><i className="bi-envelope"></i> EMAIL ADDRESS: <span>*</span></div>
                  <input type="email" id="reset_pass_email" className="text-field" placeholder="ENTER YOUR EMAIL ADDRESS" />

                  <button className="btn" type="button" id="reset_password_btn" onClick={() => setresetPassPopUp(true)}> PROCEED <i className="bi-arrow-right"></i></button>

                  <div className="notification-div login-footer-div">
                      Have you already have an account? <span className="footer-in" id="flogin" onClick={toggleForms}>Log-In</span>
                  </div>
                </div>
              )
              }
            </div>
          </div>
        </div>
      </section>

      {resetPassPopUp && <ResetPassword closeSignUp={() => setresetPassPopUp(false)} />}
      {signUpPopUp && <SignUp closeSignUp={() => setSignUpPopUp(false)} />}
      
      {showAlert && 
        <ShowAlert
          message={successMessage.message1}
          additionalMessage={successMessage.message2}
          alertResult={showAlert.result}
          onClose={alertClose}
        />
      }
    </>

  )
}
export default Login;