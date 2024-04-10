import { useState, useEffect } from 'react';
import "../Portal/Style/Paramount.css";
import { useNavigate } from 'react-router-dom';
import axios from 'axios';



export const GetFetchUserLoginProfile = (getEndPoint, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(false);

    const [getUserProfile, setgetUserProfile] = useState("");

  
    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        // Check if user is already logged in
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/portal');
            return;

        }
        const getApiEndPoint = async () => {
            setIsLoading(true);
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint, {
                    headers: {
                      'Content-Type': 'application/json',
                    }
                  });
                const getCheck = responseData.data.check;
                const result = responseData.data.result;

                if (getCheck > 0) {
                    setgetUserProfile(responseData.data.data);
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }

            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint()
    }, [navigate, getEndPoint, method, data]);

    return { getUserProfile,setgetUserProfile, isLoading };

};









export const GetUserRegExamApi = (getEndPoint, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(true);
    const [FetchData, setFetchData] = useState([]);

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }
        setIsLoading(false);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                search_txt: '',
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;

                if (getCheck > 0) {
                    if (result === true) {
                        setFetchData(responseData.data.data);
                    } else {
                       /// alert('NO RECORD FOUND!');
                    }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint, method, data]);

    return { FetchData, isLoading };

};









export const GetExamSubjectsApi = (getEndPoint, getExamId, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(true);
    const [FetchData, setFetchData] = useState([]);
  //  const [examAbbreviation, setExamAbbreviation] = useState('Xxxx');
    const [eachData, setEachData] = useState({
        abbreviation: 'Xxxx',
      });

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }
        setIsLoading(false);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                exam_id: getExamId,
                search_txt: '',
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;

                if (getCheck > 0) {
                    if (result === true) {
                        setFetchData(responseData.data.data);
                        setEachData((data) => ({
                            ...data,
                            abbreviation: responseData.data.abbreviation
                        }));
                                            //setEachData(responseData.data.abbreviation);
                    } else {
                       /// alert('NO RECORD FOUND!');
                    }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint,getExamId, method, data]);

    return { FetchData, eachData, isLoading };

};








export const GetSubjectTopicsApi = (getEndPoint, getExamId,getSubjectId, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(true);
    const [FetchData, setFetchData] = useState([]);
    const [eachData, setEachData] = useState({
        abbreviation: 'Xxxx',
        subjectName: 'Xxxx'
      });

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }
        setIsLoading(false);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                exam_id: getExamId,
                subject_id: getSubjectId,
                search_txt: '',
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;

                if (getCheck > 0) {
                    if (result === true) {
                        setFetchData(responseData.data.data);
                        setEachData((data) => ({
                            ...data,
                            abbreviation: responseData.data.abbreviation,
                            subjectName: responseData.data.subject_name
                        }));
                    } else {
                        alert('NO RECORD FOUND!');
                    }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint,getExamId, getSubjectId, method, data]);

    return { FetchData, eachData, isLoading };

};






export const GetSubTopicsApi = (getEndPoint, getTopicId, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(true);
    const [FetchData, setFetchData] = useState([]);

    const [eachData, setEachData] = useState({
        result: null,
        message: null
    });

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }
        
        setIsLoading(false);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                topic_id: getTopicId
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;
                const message = responseData.data.message;

                if (getCheck > 0) {
                    // if (result === true) {
                        setFetchData(responseData.data.data);
                        setEachData((data) => ({
                            ...data,
                            result: responseData.data.result,
                            message: responseData.data.message,
                        }));
                    // } else {
                    //     alert(message);
                    // }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint, method, data]);

    return { FetchData, eachData, isLoading };

};








export const GetSubTopicVideosApi = (getEndPoint, getSubTopic, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(true);
    const [FetchData, setFetchData] = useState([]);

    const [eachData, setEachData] = useState({
        result: null,
        message: null,
        subscription_check: null,
        exam_id: null,
        subject_id: null,
        abbreviation: null,
        subject_name: null,
        topic_name: null,
        sub_topic_name: null,
        subscription_price: null,
        subscription_duration_id: null
       // sub_topic_name: null
    });

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }
        
        setIsLoading(false);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                sub_topic_id: getSubTopic,
                search_txt: null
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;
                const message = responseData.data.message;

                if (getCheck > 0) {
                    // if (result === true) {
                        setFetchData(responseData.data.data);
                        setEachData((data) => ({
                            ...data,
                            result: responseData.data.result,
                            message: responseData.data.message,
                            subscription_check: responseData.data.subscription_check,
                            exam_id: responseData.data.exam_id,
                            subject_id: responseData.data.subject_id,
                            abbreviation: responseData.data.abbreviation,
                            subject_name: responseData.data.subject_name,
                            topic_name: responseData.data.topic_name,
                            sub_topic_name: responseData.data.sub_topic_name,
                            subscription_price: responseData.data.subscription_price,
                            subscription_duration_id: responseData.data.subscription_duration_id
                        }));
                    // } else {
                    //     alert(message);
                    // }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint, getSubTopic, method, data]);

    return { FetchData, eachData, isLoading };

};













export const GetExamSubscriptionApi = (getEndPoint, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(false);
    const [FetchData, setFetchData] = useState([]);

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }
        setIsLoading(true);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                sub_topic_id: '',
                view_report: 'view_report',
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;

                if (getCheck > 0) {
                    if (result === true) {
                        setFetchData(responseData.data.data);
                    } else {
                      //  alert('NO RECORD FOUND!');
                    }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint, method, data]);

    return { FetchData, isLoading };

};




export const GetAllTransactionApi = (getEndPoint, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(false);
    const [FetchData, setFetchData] = useState([]);

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }

        setIsLoading(true);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                payment_id: '',
                view_report: 'view_report',
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;

                if (getCheck > 0) {
                    if (result === true) {
                        setFetchData(responseData.data.data);
                    } else {
                       // alert('NO RECORD FOUND!');
                    }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint, method, data]);

    return { FetchData, isLoading };

};





export const GetAllWalletHistoryApi = (getEndPoint, method = 'POST', data = null) => {
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(false);
    const [FetchData, setFetchData] = useState([]);

    useEffect(() => {
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (!sessionToken) {
            sessionStorage.removeItem('userLoginSession');
            navigate('/user/login');
            return;
        }

        setIsLoading(true);

        const getApiEndPoint = async () => {
            const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
            const endPoint = {
                action: getEndPoint,
                view_report: '',
            };

            try {
                const responseData = await axios.post(apiUrl, endPoint);
                const getCheck = responseData.data.check;
                const result = responseData.data.result;

                if (getCheck > 0) {
                    if (result === true) {
                        setFetchData(responseData.data.data);
                    } else {
                       // alert('NO RECORD FOUND!');
                    }
                } else {
                    sessionStorage.removeItem('userLoginSession');
                    navigate('/user/login');
                }
            } catch (error) {
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
        getApiEndPoint();


    }, [navigate, getEndPoint, method, data]);

    return { FetchData, isLoading };

};





