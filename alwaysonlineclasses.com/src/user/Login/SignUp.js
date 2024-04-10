import { React} from "react";

function SignUp({closeSignUp}) {
  return (
    <>
    
      <div className="overlay-off-div animated fadeIn" id="overlay-close" onClick={(e) => {e.target.id === "overlay-close" && closeSignUp();}}>
      <div className="slide-back-div">
               <div className="header-top"><h2>SIGN-UP</h2> <button className="close-btn" onClick={() => closeSignUp()} ><i className="bi-x-lg"></i></button></div>
  
              <div className="slide-in">
  
                  <div className="fill-form-div container-div animated fadeIn">
                      
                      <div className="title-div">FULL NAME: <span>*</span></div>
                      <input  type="text" id="fullname" className="text-field" placeholder="FULL NAME" title="FULL NAME" />
                      
                      <div className="input-div">
                          <div className="title-div">EMAIL ADDRESS: <span>*</span></div>
                          <input type="email" id="reg_email" className="text-field" placeholder="EMAIL ADDRESS" title="EMAIL ADDRESS"  />
                      </div>
  
                      <div className="input-div">
                          <div className="title-div"> PHONE NUMBER: <span>*</span></div>
                          <input type="tel" id="reg_mobile" className="text-field" onkeypress="isNumber_Check()" placeholder="PHONE NUMBER" title="PHONE NUMBER"  />
                      </div>
  
                      <div className="input-div">
                          <div className="title-div">SELECT EXAM: <span>*</span></div>
                          <div className="div" id="fetch_exam">
                                
                          </div>
                      </div> 
                      
                      <div className="input-div">
                          <div className="title-div"> CREATE PASSWORD: <span>*</span></div>
                          <div className="password-container">
                              <input type="password" id="reg_password"  onkeyup="_show_password_visibility('reg_password','toggle_reg_password')" className="text-field" placeholder="CREATE PASSWORD" title="CREATE PASSWORD"  />
                              <div id="toggle_reg_password"  onclick="_togglePasswordVisibility('reg_password','toggle_reg_password')">
                                  <i className="bi-eye-slash password-toggle"></i>
                              </div>
                          </div>
                      </div>
    
                      <div className="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>
                      
                        <div className="input-div">
                            <div className="title-div"> COMFIRMED PASSWORD: <span>*</span> <span id="message">Password Not Matched!</span></div>
                            <div className="password-container">
                                <input type="password" id="reg_com_password" onkeyup="_check_password_match('reg_password','reg_com_password','toggle_reg_com_password')" className="text-field" placeholder="COMFIRMED PASSWORD" title="COMFIRMED PASSWORD" />
                                <div id="toggle_reg_com_password"  onclick="_togglePasswordVisibility('reg_com_password','toggle_reg_com_password')">
                                    <i className="bi-eye-slash password-toggle"></i>
                                </div>
                            </div> 
                        </div>
  
                      
                    
  
                     
                          <div id="get_page_id">
                               <button className="btn" type="button" id="reg_btn" onclick="_user_reg_check('user_otp_authentication');">PROCEED <i className="bi-arrow-right"></i></button>  
                          </div>
                      
                
                     
  
                      <div className="notification-div login-footer-div">
                          Have you already have an account? <span className="in"  onclick="_alert_close()">Log-In </span>
                      </div>
                     
                  </div>
                 
              </div>
          </div>
        </div>
  
 

    </>

  )
  }


export default SignUp;