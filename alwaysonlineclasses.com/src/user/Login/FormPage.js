import { React, useState} from "react";
import { GetFetchUserLoginProfile,GetSubTopicVideosApi} from './ApiFunction';

const UploadedFilesUrl = 'http://localhost:3000/UploadedFiles';
  export const LoadWalletFormPage = ({alertClose}) => {
    const { getUserProfile} = GetFetchUserLoginProfile('fetch_user_api');
    if (!getUserProfile) {
        // If user profile data is not available yet, you can return a loading state 
        return ;
    }
    const convertText = getUserProfile.fullname.toLowerCase().split(' ');
    const getName = convertText.map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
    if (eachData.result ===true){

  return (
    <>
  
         <div className="get-more-div" onClick={(e) => { e.target.className === "get-more-div" && alertClose(); }}> 

          <div className="caption-div animated zoomIn ">
              <div  className="title-div"><i className="bi-credit-card"></i> Load Wallet <div className="close" onClick={() => alertClose()}><i className="bi-x"></i></div></div>
                  <div className="div-in animated fadeInRight">
                    <div className="alert alert-success">Hi <span id="user_wallet_name"><strong >Xxxx</strong></span>, Kindly enter the amount to load your wallet.</div>
                  <div className="title">Enter Amount (₦):<span>*</span> <span style={{float:'right',fontSize:'10px', paddingTop:'7px',display:'none',color: '#f00'}}>Amount not accepted!</span></div>
                  <input className="text_field" id="wallet_amount" onkeypress="isNumber_Check();" placeholder="0.00" title="Amount" type="tel" />
                  <button className="btn" type="button" id="load_wallet_btn"  title="LOAD WALLET"  onclick="_load_wallet('<?php echo $page?>')" ><i className="bi-credit-card"></i> LOAD WALLET</button>
              </div>
          </div>
          
        </div>
 

    </>
   
  )
  }else{
    /// do nothing
  }
  };



  export const NoRecordFoundPage = ({getPageWithId, getExamId, getSubjectId, getSubjectName, getMessage,alertClose}) => {
    return (
      <>
    
        <div className="get-more-div" onClick={(e) => { e.target.className === "get-more-div" && alertClose(); }}> 
  
          <div class="caption-div caption-success-div animated zoomIn">
              <div class="div-in animated fadeInRight">
              <div class="img"><img src={UploadedFilesUrl+'/all-images/images/warning.gif'} /></div>
                  <h2>{getMessage}</h2>
                No videos available for <strong id="get_subscription_name">{getSubjectName}</strong>
                  <button class="btn" onClick={() => getPageWithId('ViewTopicsPage',getExamId, getSubjectId,null)} type="button"><i class="bi-check"></i> Okay </button>
              </div>
          </div>
            
        </div>
   

      </>
  
    )
    };





    export const UserSubscriptionPage = ({getSubTopicId, getPageWithId, alertClose}) => {
    //   const [formPopUp, setFormPopUp] = useState(true);

    // const openForm = () => {
    //   setFormPopUp(true);
    // };
  
    // const closeForm = () => {
    //   setFormPopUp(false);
    // };
      const { getUserProfile} = GetFetchUserLoginProfile('fetch_user_api');
      const { FetchData, eachData, isLoading: AjaxLoader2 } = GetSubTopicVideosApi('fetch_sub_topic_video_api',getSubTopicId);
      if (!getUserProfile) {
          // If user profile data is not available yet, you can return a loading state 
          return ;
      }
      const convertText = getUserProfile.fullname.toLowerCase().split(' ');
      const getName = convertText.map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
      if (eachData.result ===true){
      return (
        <>
          <div className="get-more-div" onClick={() => getPageWithId('ViewTopicsPage',eachData.exam_id, eachData.subject_id,null)}> 
    
              <div class="caption-div animated zoomIn">
                <div  class="title-div"><i class="bi-credit-card"></i> Subcription <div class="close" onClick={() => getPageWithId('ViewTopicsPage',eachData.exam_id, eachData.subject_id,null)}><i class="bi-x"></i></div></div>
                  <div class="div-in animated fadeInRight" >
                      <div class="alert alert-success">Hi <span><strong id="user_subcription_name">{getName}</strong></span>, you want to subcribe for <strong id="subscription_name">{eachData.sub_topic_name}</strong> video tutorials. Amount is <strong>₦<span id="subscription_price"> {eachData.subscription_price}</span></strong> for <span id="subscription_duration_id">{eachData.subscription_duration_id}</span> days.</div>
                  
                      <div class="title">SELECT PAYMENT METHOD: <span>*</span></div>
                      <select id="fund_method_id" class="text_field selectinput" title="SELECT PAYMENT METHOD">
                          <option value="" >SELECT PAYMENT METHOD</option>
                          <option value="" class="option_text">PAY WITH CARD</option>
                          <option value="" class="option_text">PAY WITH WALLET</option> 
                      </select>
                      <button class="btn" type="button" id="payment_btn"  title="MAKE PAYMENT"  onclick="_payment_subcription('<?php echo $page?>','<?php echo $ids?>')" ><i class="bi-credit-card"></i> MAKE PAYMENT</button>
                </div>
              </div>
    
          </div>
    
  
        </>
    
      )
    }else{
      
       return (
            <NoRecordFoundPage getPageWithId={getPageWithId} getExamId={eachData.exam_id} getSubjectId={eachData.subject_id}  getSubjectName={eachData.sub_topic_name}  getMessage={eachData.message} alertClose={alertClose} />
       )
    }
  };
