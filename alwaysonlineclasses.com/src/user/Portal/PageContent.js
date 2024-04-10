import React, { useState } from 'react';
import axios from 'axios';
import ShowAlert from './alert';
import { GetFetchUserLoginProfile, GetUserRegExamApi, GetExamSubjectsApi, GetSubjectTopicsApi,GetSubTopicsApi,GetSubTopicVideosApi, GetExamSubscriptionApi, GetAllTransactionApi, GetAllWalletHistoryApi } from './ApiFunction';
import {NoRecordFoundPage,UserSubscriptionPage} from './FormPage';
import "../Portal/Style/Paramount.css";

import { useNavigate } from 'react-router-dom';

const UploadedFilesUrl = 'http://localhost:3000/UploadedFiles';


const numberwithcomma = (amount) => {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



export const UserProfile = () => {

    const [successMessage, setSuccessMessage] = useState(false);
    const [showAlert, setShowAlert] = useState(false);
    const [isLoading, setIsLoading] = useState(false);

    const alertClose = () => {
        setShowAlert(false);
    };

   
    const { getUserProfile, setgetUserProfile, isLoading: AjaxLoader1 } = GetFetchUserLoginProfile('fetch_user_api');


    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setgetUserProfile({ ...getUserProfile, [name]: value });
    };
    const isValidEmail = (email) => {
        // Regular expression for a simple email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };



    /////////////// phone number js check .//////////
    const [isValid, setIsValid] = useState(true);

    const isValidPhoneNumber = (phoneNumber) => {
        // Regular expression for a phone number containing only numeric characters
        const phoneRegex = /^\d+$/;
        return phoneRegex.test(phoneNumber);
    };

    const handleKeyPress = (e) => {
        const inputMobile = e.key;
        const valid = isValidPhoneNumber(inputMobile);
        if (!valid) {
            setIsValid(null);
            e.preventDefault();
            return;
        }
        setIsValid(valid);
    };


   

    const [previewImage, setPreviewImage] = useState(null);
    const [selectedFilePix, setSelectedFilePix] = useState(null);



 
    const handleFileChange = (e) => {
        const file = e.target.files[0];
     
        if (file) {
          const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
          const fileExtension = file.name.split('.').pop().toLowerCase();
    
         if (allowedExtensions.includes(fileExtension)) {
            const reader = new FileReader();
            reader.onloadend = () => {
              setPreviewImage(reader.result);
              setSelectedFilePix(file.name);
    
              alert(`Selected image: ${file.name}`);
    
              // Uncomment the next line to trigger the file upload
              uploadPix(file);
            };
            reader.readAsDataURL(file);
          } else {
            alert('Invalid file type. Please select a valid image file.');
            // You may choose to clear the selected file and reset the preview here
          }
        }
      };
    


    const uploadPix = async (file) => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
    
        try {

            // const endPoint = {
            //     action: 'upload_passport_api',
            //     passport: selectedFilePix,
            // };
           // const responseData = await axios.post(apiUrl, endPoint);

            // const responseData = await axios.post(apiUrl, endPoint, {
            //     headers: {
            //       'Content-Type': 'application/json',
            //      // 'Content-Type': 'multipart/form-data',
            //     }
            //   });
            const formData = new FormData();
            formData.append('action', 'upload_passport_api');
            formData.append('passport', selectedFilePix);
    
            const responseData = await axios.post(apiUrl, formData, {
                headers: {
                    'Content-Type': 'application/json',
                    // 'Content-Type': 'multipart/form-data',
                },
            });
    
            const result = responseData.data.result;
            const message1 = responseData.data.message1;
            const passport = responseData.data.passport;
    
            if (result) {
                alert(message1 + ' ' + passport);
            } else {
                alert(message1);
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            setIsLoading(false);
        }
    };






    const updateProfile = async () => {
        setIsLoading(true);
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;

        const { fullname, email, mobile } = getUserProfile;

        if (!fullname) {
            setSuccessMessage({
                message1: 'FULLNAME ERROR!',
                message2: 'Fill this fields to continue',
                result: true,
                onClose: { alertClose },
            });
            setShowAlert(getUserProfile);
            setIsLoading(false);
            return;
        } else if (!email) {
            setSuccessMessage({
                message1: 'EMAIL ERROR!',
                message2: 'Fill this fields to continue',
                result: true,
                onClose: { alertClose },
            });
            setShowAlert(getUserProfile);
            setIsLoading(false);
            return;
        } else if (!isValidEmail(email)) {
            setSuccessMessage({
                message1: 'EMAIL ERROR!',
                message2: 'Invalid email address',
                result: true,
                onClose: { alertClose },
            });

            setShowAlert(getUserProfile);
            setIsLoading(false);
            return;

        } else if (!isValidPhoneNumber(mobile)) {
            setSuccessMessage({
                message1: 'PHONE NUMBER ERROR!',
                message2: 'IInvalid phone number',
                result: true,
                onClose: { alertClose },
            });
            setShowAlert(getUserProfile);
            setIsLoading(false);
            return;
        } else {

            const endPoint = {
                action: 'update_user_api',
                fullname,
                email,
                mobile,
            };
            try {
                const endpoint = await axios.post(apiUrl, endPoint);
                const responseData = endpoint.data;
                const result = responseData.result;

                if (result === true) {
                    setSuccessMessage(responseData);
                    setShowAlert(responseData);
                    setgetUserProfile({
                        // ...getUserProfile,
                        fullname: responseData.data.fullname,
                        email: responseData.data.email,
                        mobile: responseData.data.mobile,
                    });

                } else {
                    setSuccessMessage(responseData);
                    setShowAlert(responseData);
                }

            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        // return {setgetUserProfile};
    }









    // const renderUserProfile = (getUserProfile) => {
    //     return (
    //         <div className="detail">
    //             <h3 id="login_user_fullname">{getUserProfile.fullname}</h3>
    //             <span><i className="fa fa-clock-o"></i> Last Login Date </span> - <span id="login_user_login_time"> {getUserProfile.last_login}</span>
    //         </div>
    //     );
    // };



      if (AjaxLoader1) {
        return <p>Loading...</p>
    }
    return (

        <>

            {/* {<DashboardUserInfo />&& renderUserProfile(getUserProfile)} */}
            <div className="table-div animated fadeIn" id="search-content">
                <div className="div-in">
                    <div className="container-title title2"><i className="bi bi-person-square"></i> MY ROFILE </div>
                    <br clear="all" />
                    <div className="user-account-div">
                        <div className="profile-div">
                            <label>
                                <div className="profile-pix" id="profile_pix">
                                    {getUserProfile.passport ? (
                                        // Render image from the database if available
                                        <img src={previewImage || `${UploadedFilesUrl}/UserPix/${getUserProfile.passport}`} alt={getUserProfile.fullname} />
                                    ) : (
                                        // Render image from the local directory if not available in the database
                                        <img src={previewImage || `${UploadedFilesUrl}/UserPix/friends.png`} alt={getUserProfile.fullname} />
                                    )}
                                </div>

                                <input type="file" id="passport" onChange={handleFileChange} style={{ display: 'none' }} />
                            </label>


                                {/* <div {...getRootProps()} style={dropzoneStyle}>
                                        <input {...getInputProps()} />
                                        <p>Drag & drop a file here, or click to select a file</p>
                                    </div>
                                    {file && (
                                        <div>
                                        <p>Selected File: {file.name}</p>
                                        <button onClick={uploadPix}>Upload File</button>
                                        </div>
                                    )} */}

                        </div>
                        <div className="profile-div info-div">
                            <div className="title">
                                FULLNAME: <span>*</span>
                            </div>
                            <input
                                id="fullname"
                                type="text"
                                name="fullname"
                                value={getUserProfile.fullname}
                                onChange={handleInputChange}
                                className="text_field"
                                placeholder="FULLNAME"
                                title="FULLNAME"
                            />
                            <div className="title">
                                EMAIL ADDRESS: <span>*</span>
                            </div>
                            <input
                                id="email"
                                type="text"
                                name="email"
                                value={getUserProfile.email}
                                onChange={handleInputChange}
                                className="text_field"
                                placeholder="EMAIL ADDRESS"
                                title="EMAIL ADDRESS"
                            />
                            <div className="title">
                                PHONE NUMBER: <span>*</span>
                                {isValid ? null :
                                    <span style={{ float: 'right', fontSize: '10px', color: '#f00' }} id="verify_mobile_info">
                                        Phone number not accepted!
                                    </span>
                                }
                            </div>
                            <input
                                id="mobile"
                                type="text"
                                name="mobile"
                                value={getUserProfile.mobile}
                                onKeyPress={handleKeyPress}
                                onChange={handleInputChange}
                                className="text_field"
                                placeholder="PHONE NUMBER"
                                title="PHONE NUMBER"
                            />
                            <button className="action-btn" type="button" id="update_btn" disabled={AjaxLoader1} onClick={updateProfile}>
                                {isLoading ? 'UPDATING' : 'UPDATE PROFILE'}
                            </button>
                        </div>

                    </div>
                </div>
            </div>

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


};














export const UserExam = () => {
    const { FetchData: userRegExamDetails, isLoading: AjaxLoader2 } = GetExamSubscriptionApi('fetch_exam_api');
   

    // if (AjaxLoader2) {
    //     return <p>Loading...</p>
    // }

    return (
        <>

            <div className="table-div animated fadeIn" id="search-content">
                <div className="div-in">
                    <div className="container-title title2"><i className="bi-pencil-square"></i>  EXAM / VIDEO </div>
                    <div className="input-search-div">
                        <input id="search_txt" style={{ display: 'none' }} onkeyup="_fetch_users_list()" type="text" className="text_field" placeholder="Type here to search..." title="Type here to search" />
                        <button type="button" className="top-btn" onClick="_get_page('exam_category', 'exam')">Subcribe <i className="bi bi-box-arrow-in-up-right"></i></button>
                    </div>

                    <div className="table-div-in">
                        <table className="table" cellspacing="0" id="fetch_exam_details_with_limit" >
                            <tr className="tb-col">
                                <td>SN</td>
                                <td>EXAM</td>
                                <td>NO. OF SUBJECT</td>
                                <td>ACTION</td>

                            </tr>

                            {userRegExamDetails.map((record, index) => (
                                <tr key={record.exam_id}>

                                    <td>{index + 1}</td>
                                    <td className="logo-tb logo-tb2">
                                        <div className="logo-div">
                                            {record.exam_passport ? (
                                                // Render image from the database if available
                                                <img src={`${UploadedFilesUrl}/ExamPix/${record.exam_passport}`} alt={`${record.abbreviation} LOGO`} />
                                            ) : (
                                                // Render image from the local directory if not available in the database
                                                <img src={`${UploadedFilesUrl}/ExamPix/default_pix.jpg`} alt={`${record.abbreviation} LOGO`} />
                                            )}
                                        </div>
                                        <span id="">{record.abbreviation.toUpperCase()}</span>
                                    </td>
                                    <td>{record.exam_subject_count.toUpperCase()}</td>

                                    <td>
                                        <button className="btn">
                                            <i className="bi bi-play"></i> VIEW
                                        </button>
                                    </td>
                                </tr>
                            ))}


                        </table>
                    </div>
                    <div className="bottom-count-div">
                        <span id="dashboard_sub_count">{userRegExamDetails.length}</span> of <span id="dashboard_sub_total_count">{userRegExamDetails.length}</span>


                        <button className="top-btn bottom-btn" onClick="_get_page('exam_category', 'exam')" id="exam" type="button" ><i className="bi bi-eye"></i> View All</button>
                    </div>
                </div>

            </div>

        </>
    )

};









export const ExamModuleComponent = () => {
    const { FetchData: userRegExamDetails, isLoading: AjaxLoader2 } = GetExamSubscriptionApi('fetch_exam_api');
    const [formPopUp, setFormPopUp] = useState(true);

    
    const [pageDetail, setPageDetail] = useState({
      getPage: null,
      examId: null,
      subjectId: null,
      subTopicId: null,
    });
  
    const getPageWithId = (getPage, examId, subjectId,subTopicId) => {
      // Update state based on the previous state
      setPageDetail((prevIds) => ({
        ...prevIds,
        getPage: getPage,
        examId: examId,
        subjectId: subjectId,
        subTopicId: subTopicId
      }));
    };
  
    const openForm = () => {
        setFormPopUp(true);
        
      };
    
      const closeForm = (getPage, examId, subjectId,subTopicId) => {
        setFormPopUp(false);
        setPageDetail((prevIds) => ({
            ...prevIds,
            getPage: getPage,
            examId: examId,
            subjectId: subjectId,
            subTopicId: subTopicId
          }));
      };
    const [formDetail, setFormDetail] = useState({
        getPage: null,
        examId: null,
        subjectId: null,
        subTopicId: null,
      });

    const getFormWithId = (getPage, examId, subjectId,subTopicId) => {
        // Update state based on the previous state
        setFormDetail((prevIds) => ({
          ...prevIds,
          getPage: getPage,
          examId: examId,
          subjectId: subjectId,
          subTopicId: subTopicId
        }));
      };

//    if (formDetail.getPage === 'SubForm' && formDetail.subTopicId !== null) {
       
//         return <UserSubscriptionPage getSubTopicId={formDetail.subTopicId} getPageWithId={'ViewTopicsPage'}/>;

//     }else{

//         /// do nothing
   
//     }
    if (pageDetail.getPage === null && pageDetail.examId === null) {
      return (
        <ExamCategory
          userRegExamDetails={userRegExamDetails}
          getPageWithId={getPageWithId}
          UploadedFilesUrl={UploadedFilesUrl}
        />
      );
    } else if (pageDetail.getPage === 'ViewSubjectPage' && pageDetail.examId !== null) {
        return <ExamSubjects pageDetail={pageDetail.examId} getPageWithId={getPageWithId} />;

    } else if (pageDetail.getPage === 'ViewTopicsPage' && pageDetail.examId !== null && pageDetail.subjectId !== null) {
        return <SubjectTopics getExamId={pageDetail.examId} getSubjectId={pageDetail.subjectId} getPageWithId={getPageWithId} getFormWithId={getFormWithId}/>;
    
    } else if (pageDetail.getPage === 'ViewTopicVideosPage' && pageDetail.subTopicId !== null) {
        return <SubTopicsVideos getSubTopicId={pageDetail.subTopicId} getPageWithId={getPageWithId}/>;
    
    } else if (pageDetail.getPage === 'UserSubscriptionPage' && pageDetail.subTopicId !== null) {
       return ( formPopUp  && <UserSubscriptionPage getSubTopicId={pageDetail.subTopicId} getPageWithId={getPageWithId} /> );
        // return ( formPopUp  && <UserSubscriptionPage getSubTopicId={pageDetail.subTopicId} getPageWithId={getPageWithId} alertClose={closeForm('ViewTopicsPage',pageDetail.examId, pageDetail.subTopicId, null)} /> )
       
    }else{
        /// do nothing
    }
    

    
  };
  







export const ExamCategory = ({ userRegExamDetails, getPageWithId, UploadedFilesUrl }) => {

    return (
        <>

                <div className="container-content-div">
                    <div className="div-in">    
                        <div className="container-title title2"><i className="bi-pencil-square"></i> EXAM'S LIST</div>
                        <button type="button" className="top-btn top-btn2" onClick="_get_form('add_more_exam')"> <i className="bi-plus-square"></i> Add More Exam </button>
                        
                        <div className="input-search-div input-search2">
                            <input id="search_txt" onkeyup="_search_content('<?php echo $page?>','','')" type="text" className="text_field text_field2" placeholder="Type here to search..." title="Type here to search" />
                        </div>

                        <br clear="all" />


                            <div className="fetch animated fadeIn" id="fetch_exam_details">
                            {userRegExamDetails.map((record) => (
                                 <div className="fetch-div animated fadeIn" key={record.exam_id}>			
                                    <div className="record-content-div">
                                        <div className="div-in">
                                            <div className="image-div">
                                            <img src={`${UploadedFilesUrl}/ExamPix/${record.exam_passport}`} alt={`${record.abbreviation} LOGO`} />
                                            </div>

                                            <div className="text-div">
                                                <h2>{record.abbreviation.toUpperCase()}</h2>
                                                    <p>{record.seo_description}</p>
                                                <div className="count-div">
                                                    <div class="count-in"><i class="bi-book"></i> SUBJECT: <span >{record.exam_subject_count}</span> </div>
                                                    <button class="btn"  title="VIEW SUBJECT" onClick={() => getPageWithId('ViewSubjectPage',record.exam_id,null)} ><i class="bi-pencil-square"></i> VIEW SUBJECT</button>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div> 
                                ))}
                            
                        </div> 
                    </div> 
                        
                        <br clear="all" />
                </div>

        </>

    )

};







export const ExamSubjects = ({pageDetail,getPageWithId}) => {
    const { FetchData: examSubjectDetails,eachData, isLoading: AjaxLoader2 } = GetExamSubjectsApi('fetch_exam_subject_api',pageDetail);
    
    return (
        <>

                <div className="container-content-div">
                    <div className="div-in">    
                        <button type="button" className="top-btn top-btn2" onClick="_get_form('add_more_exam')"> <i className="bi-plus-square"></i> Add More Exam </button>
                        <div class="container-title title2"><i class="bi-book"></i> EXAM / <span id="exam_abbreviation">{eachData.abbreviation.toUpperCase()}</span> / <span style={{color: '#444'}}>SUBJECT'S LIST</span> </div>
                        <div className="input-search-div input-search2">
                            <input id="search_txt" onkeyup="_search_content('<?php echo $page?>','','')" type="text" className="text_field text_field2" placeholder="Type here to search..." title="Type here to search" />
                        </div>

                        <br clear="all" />


                            <div className="fetch animated fadeIn" id="fetch_exam_details">
                            {examSubjectDetails.map((record) => (
                                    <div class="grid-div animated fadeIn">
                                        <div class="div-in">
                                            <div class="image-div">
                                                <img src={`${UploadedFilesUrl}/SubjectPix/${record.subject_passport}`} alt={`${record.abbreviation} LOGO`} />
                                            </div>
                                            <div class="status-div">SUBJECT</div>
                                            <div class="info-div">
                                                <h2>{record.subject_name.toUpperCase()}</h2>
                                                <hr></hr>
                                                <div class="count-div"><i class="bi-book"></i> TOPICS: <span>{record.subject_topic_count}</span> </div>
                                                <button class="btn btn2" title="VIEW TOPICS" onClick={() => getPageWithId('ViewTopicsPage',record.exam_id, record.subject_id)} ><i class="bi-book"></i> VIEW TOPICS</button>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            
                        </div> 
                    </div> 
                        
                        <br clear="all" />
                </div>

        </>

    )

};









export const SubjectTopics = ({getExamId, getSubjectId,getPageWithId,getFormWithId}) => {
        const { FetchData: SubjectTopicstDetails,eachData, isLoading: AjaxLoader2 } = GetSubjectTopicsApi('fetch_topic_api',getExamId,getSubjectId);
    
    
        const [collapsedStates, setCollapsedStates] = useState(true);

        const toggleCollapse = (itemId) => {
          setCollapsedStates((prevStates) => ({
            ...prevStates,
            [itemId]: !prevStates[itemId],
          }));
        };

    return (
        <>

                <div className="container-content-div">
                    <div className="div-in">    
                        <button type="button" className="top-btn top-btn2" onClick="_get_form('add_more_exam')"> <i className="bi-plus-square"></i> Add More Exam </button>
                        <div class="container-title title2"><i class="bi-book"></i> EXAM / <span id="exam_abbreviation">{eachData.abbreviation.toUpperCase()}</span> / <span id="subject_name">{eachData.subjectName.toUpperCase()}</span> / <span style={{color: '#444'}}>TOPIC'S LIST </span></div>

                        <div class="input-search-div">
                            <input id="search_txt" onkeyup="_search_content('<?php echo $page?>','<?php echo $ids?>','<?php echo $other_ids?>')" type="text" class="text_field search_right" placeholder="Type here to search..." title="Type here to search" />
                        </div>

                        <br clear="all" />

                        <div class="faq-back-div">
                            <div class="faq-text-div">

                                {SubjectTopicstDetails.map((record) => (
                                    <div class="quest-faq-div animated fadeIn">
                                        <div class="faq-title-text">
                                            <h3>{record.topic_name}</h3>
                                        </div>
                                        <div class="faq-answer-div" onClick={() => toggleCollapse(record.topic_id)}>
                                            <span>Sub Topics: </span>&nbsp;&nbsp;<span class="count-div">{record.sub_topic_count}</span> &nbsp;&nbsp;
                                            <div class="expand-div"  >&nbsp; {collapsedStates[record.topic_id] ? <i class="bi-dash"></i> : <i class="bi-plus"></i>}&nbsp;</div>
                                        </div>
                                        <div className={`faq-answer-div ${collapsedStates[record.topic_id] ? '' : 'collapsed-content'}`} >
                                       
                                            {/* <SubTopics getPage={collapsedStates.getPage} getTopicId={record.topic_id} /> */}
                                           
                                            {collapsedStates[record.topic_id] ? (
                                              <SubTopics  getTopicId={record.topic_id} getPageWithId={getPageWithId} getFormWithId={getFormWithId} />
                                            ) : (
                                                 null
                                            )}
                                        {/*                                       
                                        {SubTopicstDetails.map((record) => (
                                            <div class="topics-content-div">
                                                <div class="image-div">
                                                    <img src={`${UploadedFilesUrl}/ExamPix/${record.exam_passport}`} alt={`${record.abbreviation} LOGO`} />
                                                </div>
                                                <div class="text">
                                                    <h4>{record.sub_topic_name}</h4>
                                                    <p>{record.seo_description}</p>
                                                    <button class="btn btn2" title="VIEW VIDEOS" >VIEW VIDEOS <i class="bi-eye"></i></button>
                                                    <button class="btn count_btn" title="NO OF VIDEOS" >NO OF VIDEOS: <span>{record.nums_of_videos}</span></button>
                                                    <br/>
                                                    <div class="amount-div">Subcription Fee:&nbsp; ₦ <span id="">{numberwithcomma(record.subscription_price)}</span> </div>
                                                    <div class="amount-div">Duration: <span class="due-date"> {record.subscription_duration_id} days</span> </div>
                                                    <div class="amount-div">Due Date: <span class="due-date"> {record.due_date}</span> </div>
                                                </div>
                                            </div>
                                        ))} */}

                                        </div>
                                    </div>
                                ))}

                            </div>
                        </div> 
                            
                    </div> 
                        
                        <br clear="all" />
                </div>

        </>

    )

};




export const SubTopics = ({getTopicId,getPageWithId,getFormWithId}) => {
//     const [formPopUp, setFormPopUp] = useState(false);
//     const openForm = () => {
//         setFormPopUp(true);
//    };

//    const closeForm = () => {
//        setFormPopUp(false);
//    };

        const { FetchData: SubTopicstDetails, eachData} = GetSubTopicsApi('fetch_sub_topic_api',getTopicId);
        
        if (eachData.result ===true){
            return (
                <>
                   
                    {SubTopicstDetails.map((record) => {
                        if (record.subscribed === 'yes') {
                            return (
                                <div class="topics-content-div" key={record.id}>
                                    <div class="image-div">
                                    <img src={`${UploadedFilesUrl}/ExamPix/${record.exam_passport}`} alt={`${record.abbreviation} LOGO`} />
                                    </div>
                                    <div class="text">
                                    <h4>{record.sub_topic_name}</h4>
                                    <p>{record.seo_description}</p>
                                    <button class="btn btn2" title="VIEW VIDEOS" onClick={() => getPageWithId('ViewTopicVideosPage',null, null, record.sub_topic_id)}>VIEW VIDEOS <i class="bi-eye"></i></button>
                                    <button class="btn count_btn" title="NO OF VIDEOS" onClick={() => getPageWithId('ViewTopicVideosPage',null, null, record.sub_topic_id)}>NO OF VIDEOS: <span>{record.nums_of_videos}</span></button>
                                    <br/>
                                    <div class="amount-div">Subcription Fee:&nbsp; ₦ <span id="">{numberwithcomma(record.subscription_price)}</span> </div>
                                    <div class="amount-div">Duration: <span class="due-date"> {record.subscription_duration_id} days</span> </div>
                                    <div class="amount-div">Due Date: <span class="due-date"> {record.due_date}</span> </div>
                                    </div>
                                </div>
                            );
                            } else {
                                return (
                                <div class="topics-content-div">
                                    <div class="image-div">
                                        <img src={`${UploadedFilesUrl}/ExamPix/${record.exam_passport}`} alt={`${record.abbreviation} LOGO`} />
                                    </div>
                                    <div class="text">
                                        <h4>{record.sub_topic_name}</h4>
                                        <p>{record.seo_description}</p>
                                        <button class="btn" title="SUBCRIBE" onClick={() => getPageWithId('UserSubscriptionPage',null, null, record.sub_topic_id)}> SUBCRIBE <i class="bi-box-arrow-in-up-right"></i></button>
                                        <button class="btn count_btn" title="NO OF VIDEOS" onClick={() => getPageWithId('ViewTopicVideosPage',null, null, record.sub_topic_id)}>NO OF VIDEOS: <span>{record.nums_of_videos}</span></button>
                                        <br/>
                                        <div class="amount-div">Subcription Fee:&nbsp; ₦ <span id="">{numberwithcomma(record.subscription_price)}</span> </div>
                                        <div class="amount-div">Duration: <span class="due-date"> {record.subscription_duration_id} days</span> </div>
                                    </div>
                                </div>
                            )
                        }
                    })}


                </>
    
            )
        }else{
            return(
                <div class="false-notification-div">
                    <p>{eachData.message} </p>
                </div>
            )
        }
       
       
};














export const SubTopicsVideos = ({getSubTopicId, getPageWithId}) => {
    const [formPopUp, setFormPopUp] = useState(false);

    const openForm = () => {
         setFormPopUp(true);
    };

    const closeForm = () => {
        setFormPopUp(false);
    };
    const { FetchData: SubTopicVideosDetails, eachData, isLoading: AjaxLoader2 } = GetSubTopicVideosApi('fetch_sub_topic_video_api',getSubTopicId);


        return (

            <>
                {eachData.result === true ? (
                    <div class="container-content-div">
                        <div class="div-in"> 
                            <div class="container-title title2"><i class="bi-book"></i> EXAM / <span id="exam_abbreviation">{eachData.abbreviation.toUpperCase()}</span> / <span id="subject_name">{eachData.subject_name.toUpperCase()}</span> / <span id="topic_name">{eachData.topic_name.toUpperCase()} </span> / <span id="sub_topic_name">{eachData.sub_topic_name.toUpperCase()} </span> /<span class="list">VIDEOS</span></div>
                            <div class="input-search-div">
                                <input id="search_txt" onkeyup="_search_content('<?php echo $page?>','<?php echo $ids?>','<?php echo $other_ids?>')" type="text" class="text_field search_right" placeholder="Type here to search..." title="Type here to search" />
                            </div>
                            <br clear="all"/>
                                        
                            <div class="faq-back-div" >
                                <div class="faq-text-div ">
                                    <div class="quest-faq-div animated fadeIn">
                                        
                                    {SubTopicVideosDetails.map((record) => {
                                        const htmlContent = record.video_objective;

                                        const videoImageSrc = UploadedFilesUrl+'/sub_topic_video_pix/' + record.video_passport;

                                        return (
                                            <div class="faq-answer-div animated fadeIn" id="faq1answer">
                                                <div class="topics-content-div">
                                                    <div class="image-div video-img">
                                                        <img src={videoImageSrc} alt={record.video_title} />
                                                    </div>
                                                    <div class="text video-text">
                                                        <h4>{record.video_title}</h4>
                                                        <p dangerouslySetInnerHTML={{ __html: htmlContent }} />

                                                        {eachData.subscription_check === 1 ? (
                                                            <button class="btn btn2" title="PLAY VIDEO">PLAY VIDEO <i class="bi-play"></i></button>
                                                        ) : (
                                                            record.subscription_pricing_id === 1 ? (
                                                                <button class="btn btn2" title="PLAY VIDEO">PLAY VIDEO <i class="bi-play"></i></button>
                                                            ) : (
                                                                <button class="btn" title="SUBSCRIBE">SUBSCRIBE <i class="bi-box-arrow-in-up-right"></i></button>
                                                            )
                                                        )}
                                                        <div class="details">{record.video_volume_name}</div>
                                                        <div class="details">{record.subscription_pricing_name}</div>
                                                        <div class="details">{record.video_duration}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        );
                                    })}

                                    </div>
                                </div> 

                            </div> 

                        </div>
                        <br clear="all" />

                    </div>

                
                ) : (
                     <NoRecordFoundPage getPageWithId={getPageWithId} getExamId={eachData.exam_id} getSubjectId={eachData.subject_id} getSubjectName={eachData.sub_topic_name} getMessage={eachData.message} alertClose={closeForm} />
                )}

            </>
        );

};












export const ExamSubscriptions = () => {
    const { FetchData: userExamSubDetails, isLoading: AjaxLoader1 } = GetUserRegExamApi('fetch_subscription_api');

    // if (AjaxLoader1) {
    //     return <p>Loading...</p>
    // }

    return (

        <div className="table-div animated fadeIn" id="search-content">
            <div className="div-in">
                <div className="container-title title2"><i className="bi-pencil-square"></i>  EXAM SUBSCRIPTION </div>
                <div className="input-search-div">
                    <input id="search_txt" style={{ display: 'none' }} onkeyup="_fetch_users_list()" type="text" className="text_field" placeholder="Type here to search..." title="Type here to search" />
                    <button type="button" className="top-btn" onClick="_get_page('exam_category', 'exam')">Subcribe <i className="bi bi-box-arrow-in-up-right"></i></button>
                </div>

                <div className="table-div-in">
                    <table className="table" cellspacing="0" id="fetch_exam_details_with_limit" >
                        <tr className="tb-col">
                            <td>SN</td>
                            <td>EXAM</td>
                            <td>SUBJECT</td>
                            <td>TOPIC</td>
                            <td>SUB-TOPIC</td>
                            <td>DATE</td>
                            <td>DUE DATE</td>
                            <td>STATUS</td>
                            <td>ACTION</td>
                        </tr>

                        {userExamSubDetails.map((record, index) => (
                            <tr key={record.exam_id}>

                                <td>{index + 1}</td>
                                <td className="logo-tb logo-tb2">
                                    <div className="logo-div">
                                        {record.exam_passport ? (
                                            // Render image from the database if available
                                            <img src={`${UploadedFilesUrl}/ExamPix/${record.exam_passport}`} alt={`${record.abbreviation} LOGO`} />
                                        ) : (
                                            // Render image from the local directory if not available in the database
                                            <img src={`${UploadedFilesUrl}/ExamPix/default_pix.jpg`} alt={`${record.abbreviation} LOGO`} />
                                        )}
                                    </div>
                                    <span id="">{record.abbreviation.toUpperCase()}</span>
                                </td>
                                <td>{record.subject_name.toUpperCase()}</td>
                                <td>{record.topic_name.toUpperCase()}</td>
                                <td>{record.sub_topic_name.toUpperCase()}</td>
                                <td>{record.date}</td>
                                <td>{record.due_date}</td>
                                <td>
                                    <div className={`status-div ${record.status_name}`}>
                                        {record.status_name.toUpperCase()}
                                    </div>
                                </td>
                                <td>
                                    <button className="btn">
                                        <i className="bi bi-play"></i> PLAY
                                    </button>
                                </td>
                            </tr>
                        ))}


                    </table>
                </div>
                <div className="bottom-count-div">
                    <span id="dashboard_sub_count">{userExamSubDetails.length}</span> of <span id="dashboard_sub_total_count">{userExamSubDetails.length}</span>


                    <button className="top-btn bottom-btn" onClick="_get_page('exam_category', 'exam')" id="exam" type="button" ><i className="bi bi-eye"></i> View All</button>
                </div>
            </div>

        </div>


    )

};








export const Transactions = () => {
    const { FetchData: TransactionDetails, isLoading: AjaxLoader3 } = GetAllTransactionApi('fetch_transaction_history_api');

    // if (AjaxLoader3) {
    //     return <p>Loading...</p>;
    // }
    return (
        <>

            <div className="table-div animated fadeIn" id="search-content">
                <div className="div-in">
                    <div className="container-title title2"><i className="bi bi-credit-card"></i>  TRANSACTIONS  </div>
                    <div className="input-search-div">
                        <input id="search_txt" style={{ display: 'none' }} onkeyup="_fetch_users_list()" type="text" className="text_field" placeholder="Type here to search..." title="Type here to search" />
                        <button type="button" className="top-btn" onClick="_get_page('exam_category', 'exam')">Subcribe <i className="bi bi-box-arrow-in-up-right"></i></button>
                    </div>

                    <div className="table-div-in">
                        <table className="table" cellspacing="0" id="fetch_exam_details_with_limit" >
                            <tr className="tb-col">
                                <td>SN</td>
                                <td>DATE</td>
                                <td>TRANSACTION ID</td>
                                <td>TRANSACTION TYPE</td>
                                <td>TRANSACTION METHOD</td>
                                <td>AMOUNT</td>
                                <td>STATUS</td>
                                <td>ACTION</td>

                            </tr>

                            {TransactionDetails.map((record, index) => (
                                <tr key={record.exam_id}>

                                    <td>{index + 1}</td>
                                    <td>{record.date}</td>
                                    <td>{record.payment_id}</td>
                                    <td>{record.transaction_type_name}</td>
                                    <td>{record.fund_method_name}</td>
                                    <td>{`₦ ${numberwithcomma(record.amount)}`}</td>

                                    <td><div className={`status-div ${record.status_name}`}>{record.status_name}</div></td>

                                    <td>
                                        <button className="btn">
                                            <i className="bi bi-eye"></i> DETAILS
                                        </button>
                                    </td>
                                </tr>
                            ))}


                        </table>
                    </div>
                    <div className="bottom-count-div">
                        <span id="dashboard_sub_count">{TransactionDetails.length}</span> of <span id="dashboard_sub_total_count">{TransactionDetails.length}</span>


                        <button className="top-btn bottom-btn" onClick="_get_page('exam_category', 'exam')" id="exam" type="button" ><i className="bi bi-eye"></i> View All</button>
                    </div>
                </div>

            </div>



        </>

    )

};






export const WalletHistory = () => {
    const { FetchData: WalletHistoryDetails, isLoading: AjaxLoader4 } = GetAllWalletHistoryApi('fetch_wallet_history_api');

    // if (AjaxLoader4) {
    //     return <p>Loading...</p>;
    // }
    return (
        <>

            <div className="table-div animated fadeIn" id="search-content">
                <div className="div-in">
                    <div className="container-title title2"><i className="bi bi-credit-card"></i>  WALLET HISTORY  </div>
                    <div className="input-search-div">
                        <input id="search_txt" style={{ display: 'none' }} onkeyup="_fetch_users_list()" type="text" className="text_field" placeholder="Type here to search..." title="Type here to search" />
                        <button type="button" className="top-btn" onClick="_get_page('exam_category', 'exam')">Subcribe <i className="bi bi-box-arrow-in-up-right"></i></button>
                    </div>

                    <div className="table-div-in">
                        <table className="table" cellspacing="0" id="fetch_exam_details_with_limit" >
                            <tr className="tuple">
                                <td>SN</td>
                                <td>DATE</td>
                                <td>TRANSACTION ID</td>
                                <td>BALANCE BEFORE</td>
                                <td>AMOUNT LOADED</td>
                                <td>BALANCE AFTER</td>
                                <td>TRANSACTION TYPE</td>
                                <td>STATUS</td>
                            </tr>




                            {WalletHistoryDetails.map((record, index) => (
                                <tr key={record.exam_id}>

                                    <td>{index + 1}</td>
                                    <td>{record.date}</td>
                                    <td>{record.payment_id}</td>
                                    <td>{`₦ ${numberwithcomma(record.balance_before)}`}</td>
                                    <td className="amount_load">{`₦ ${numberwithcomma(record.amount)}`}</td>
                                    <td>{`₦ ${numberwithcomma(record.balance_after)}`}</td>
                                    <td>{record.transaction_type_name}</td>

                                    <td><div className={`status-div ${record.status_name}`}>{record.status_name}</div></td>

                                </tr>
                            ))}


                        </table>
                    </div>
                    <div className="bottom-count-div">
                        <span id="dashboard_sub_count">{WalletHistoryDetails.length}</span> of <span id="dashboard_sub_total_count">{WalletHistoryDetails.length}</span>
                        <button className="top-btn bottom-btn" onClick="_get_page('exam_category', 'exam')" id="exam" type="button" ><i className="bi bi-eye"></i> View All</button>
                    </div>
                </div>

            </div>



        </>

    )

};