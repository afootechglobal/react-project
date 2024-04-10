import { React, useState } from 'react';
import { GetFetchUserLoginProfile} from './ApiFunction';
import {LoadWalletFormPage} from './FormPage';
const UploadedFilesUrl = 'http://localhost:3000/UploadedFiles';






const DashboardUserInfo = ({ pageTitle }) => {

    const { getUserProfile} = GetFetchUserLoginProfile('fetch_user_api');
    const [Masked, setMasked] = useState(false);

   
    const [formPopUp, setFormPopUp] = useState(false);

    const openForm = () => {
      setFormPopUp(true);
    };
  
    const closeForm = () => {
      setFormPopUp(false);
    };

    const toggleMask = () => {
        setMasked((prev) => !prev);
    };

    const getMaskedAmount = (wallet_balance) => {
        return Masked ? '****' : wallet_balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }


    if (!getUserProfile) {
        // If user profile data is not available yet, you can return a loading state
        return ;
    }

    const renderUserProfile = () => {
        const convertText = getUserProfile.fullname.toLowerCase().split(' ');
        const fetchData = convertText.map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
  
        return (
            <div className="detail">
                <h3 id="login_user_fullname">{fetchData}</h3>
                <span><i className="fa fa-clock-o"></i> Last Login Date </span> - <span id="login_user_login_time"> {getUserProfile.last_login}</span>
            </div>
        );
    };


    return (
        <>
 
            <div className="the-title-div">
                <h2 className="title-text2">USER PORTAL</h2><span id="page-title"> <i className={pageTitle.icon}></i> {pageTitle.title} </span>

                <div className="user-desc">
                    <div className="div-in">
                        {getUserProfile.passport ? (
                            <div className="pix-div" id="welcome_pix" ><img src={`${UploadedFilesUrl}/UserPix/${getUserProfile.passport}`} id="passportimg3" alt={getUserProfile.fullname} /></div>
                        ) : (
                            <div className="pix-div" id="welcome_pix" ><img src={`${UploadedFilesUrl}/UserPix/friends.png`} id="passportimg3" alt={getUserProfile.fullname} /></div>
                        )}
                        {/* <div className="detail">
                            <h3 id="login_user_fullname">{getUserProfile.fullname}</h3>
                            <span><i className="fa fa-clock-o"></i> Last Login Date </span> - <span id="login_user_login_time"> {getUserProfile.last_login}</span>
                        </div> */}
                            {renderUserProfile()}
                        <div className="amount-div amount1">
                            {/* <div className="price">₦ <span id="user_wallet_balance">{numberWithCommas(getUserProfile.wallet_balance)}</span><span id="text_in"></span> <span onclick="_hide_and_show_wallet();" id="hide_show"><i className="bi-eye"></i></span></div> */}
                            <div className="price">₦ <span>{getMaskedAmount(getUserProfile.wallet_balance)}</span> <span onClick={toggleMask} id="hide_show"><i className={`bi ${Masked ? 'bi-eye-slash' : 'bi-eye'}`}></i></span></div>
                            <button className="btn" onClick={openForm} ><i className="bi bi-wallet2"></i> Load Wallet</button>
                        </div>

                    </div>
                </div>

                <div className="user-desc mobile-user-desc">
                    <div className="div-in">
                        {getUserProfile.passport ? (
                            <div className="pix-div mobile-pix-div" id="welcome_pix" ><img src={`${UploadedFilesUrl}/UserPix/${getUserProfile.passport}`} id="passportimg3" alt={getUserProfile.fullname} /></div>
                        ) : (
                            <div className="pix-div mobile-pix-div" id="welcome_pix" ><img src={`${UploadedFilesUrl}/UserPix/friends.png`} id="passportimg3" alt={getUserProfile.fullname} /></div>
                        )}
                        <div className="detail mobile-detail">
                            <h3 id="login_user_fullname">{getUserProfile.fullname}</h3>
                            <span><i className="fa fa-clock-o"></i> Last Login Date </span> - <span id="login_user_login_time">xxxx</span>
                        </div>

                        <div className="amount-div mobile-amount">
                            <div className="price mobile-price"><span className="text">Wallet Ballance</span> <span className="text" onClick={toggleMask} id="mobile_hide_show" ><i className={`bi ${Masked ? 'bi-eye-slash' : 'bi-eye'}`}></i></span><br /> ₦ <span id="user_mobile_wallet_balance">{getMaskedAmount(getUserProfile.wallet_balance)}</span></div>
                            <button className="btn mobile-btn" onClick="_get_form('load_user_wallet','load_wallet')" id="load_wallet"><i className="bi bi-wallet2"></i> Load Wallet</button>
                        </div>

                    </div>
                </div>

            </div>

            {formPopUp && <LoadWalletFormPage alertClose={closeForm} />}
            
        </>

    )

}
export default DashboardUserInfo;

