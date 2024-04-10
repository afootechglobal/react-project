import {React, createContext, useContext, useState, useEffect } from 'react';
import axios from 'axios';

import { useNavigate, useLocation, Navigate } from 'react-router-dom';


const UserContext = createContext();

export const UserProvider = ({ children }) => {
    const location = useLocation();
    const navigate = useNavigate ();
    const getAccessKey = location.state?.getAccessKey;
   

    const [userProfile, setUserProfile] = useState("");
  
    const [getToken, setGetToken] = useState({
        access_key: getAccessKey,
    });

   
    useEffect(() => {
        
        const fetchUserInfo = async () => {
            ///// check if session is empty
            const sessionToken = JSON.parse(sessionStorage.getItem('userLoginSession'));
            if (!sessionToken) {
                // User is not authenticated, redirect to login
                sessionStorage.removeItem('userLoginSession');
                navigate('/user/login');
                return;
            } 
                
                const apiUrl = 'http://localhost/api/user/?access_key=' + sessionToken.access_key;
                try {
                    const responseData = await axios.post(apiUrl, getToken);
                    const getCheck = responseData.data.check;
                    // const message1 = responseData.data.message1;
                    const savedData = JSON.parse(sessionStorage.getItem('userLoginSession'));
                    if (getCheck > 0) {
                            setUserProfile(savedData.data);
                            setGetToken(responseData);
                    } else {
                        // Handle failure
                       sessionStorage.removeItem('userLoginSession');
                       navigate('/user/login');
                    }
                } catch (error) {
                    // Handle fetch error
                    console.error('Error:', error);
                }
        };
        fetchUserInfo();
    }, [getAccessKey,getToken,Navigate]);



return (
    <UserContext.Provider value={userProfile}>
      {children}
    </UserContext.Provider>
  );
};


export const useUser = () => {
    return useContext(UserContext);
};
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    




const ActiveItemContext = createContext();

export const useActiveItem = () => {
  return useContext(ActiveItemContext);
};

export const ActiveItemProvider = ({ children }) => {
  const [activeItem, setActiveItem] = useState('Dashboard');

  const setItem = (item) => {
    setActiveItem(item);
  };

  return (
    <ActiveItemContext.Provider value={{ activeItem, setItem }}>
      {children}
    </ActiveItemContext.Provider>
  );
};
