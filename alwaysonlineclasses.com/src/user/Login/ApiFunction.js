import { useState, useEffect } from 'react';
import "../Portal/Style/Paramount.css";
import { useNavigate } from 'react-router-dom';
import axios from 'axios';



export const GetLoginApi = (getEndPoint, method = 'POST', data = null) => {

    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(false);

    //// alert useSate paramenters
    const [successMessage, setSuccessMessage] = useState(false);
    const [showAlert, setShowAlert] = useState(false);


    const [loginData, setLoginData] = useState({
        action: getEndPoint,
        email: '',
        password: '',
      });
    
     
    useEffect(() => {
        // Check if user is already logged in
        const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
        if (sessionToken) {
            navigate('/user/portal');
        }
        
        const getApiEndPoint = async () => {
            setIsLoading(true);
            const apiUrl = 'http://localhost/api/user/';

            try {

                const endpoint = await axios.post(apiUrl, loginData);
                const responseData = endpoint.data;
                const result = responseData.result;
                // const message1 = responseData.message1;
                // const message2 = responseData.message2;

            if (result === true) {

                sessionStorage.setItem("userLoginSession", JSON.stringify(responseData));
                const getAccessKey = responseData.access_key;
                const getUserId = responseData.user_id;
                setSuccessMessage(responseData);
                setShowAlert(responseData);
                navigate('/user/portal', { state: { getAccessKey: getAccessKey,  getUserId: getUserId } });
                
            } else {
                setSuccessMessage(responseData);
                setShowAlert(responseData);
            }

            } catch (error) {
                // fetch error
                console.error('Error:', error);
            } finally {
                setIsLoading(false);
            }
        };
       

    }, [navigate, getEndPoint, method, data]);
    return {successMessage,showAlert,setShowAlert,loginData, setLoginData, isLoading };

};









