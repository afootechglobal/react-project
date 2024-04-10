import React, { useEffect, useState } from 'react';
import { Routes, Route } from 'react-router-dom';
import HomePage from "./Pages/HomePage";
import AboutUsPage from "./Pages/AboutUsPage";
import ExamPage from "./Pages/ExamPage";
import ContactUsPage from "./Pages/ContactUsPage";
import FaqsPage from "./Pages/FaqsPage";
import Layout from "./Pages/Layout";
import PortalLayout from "./user/Portal/Layout";
import { UserProfile, UserExam, ExamModuleComponent, ExamSubscriptions, Transactions, WalletHistory } from "./user/Portal/PageContent";
import LoginPage from "./user/Login/login";
import { useNavigate } from 'react-router-dom';
import { ActiveItemProvider } from './user/Portal/ActiveItemContext';

function App() {
  const navigate = useNavigate();


  useEffect(() => {
    if (!sessionStorage.getItem('userLoginSession')) {
      sessionStorage.removeItem('userLoginSession');
      navigate('/');
      return;
    }

  }, []);




  const UserPortal = () => {
    return (

    <>
      <UserExam />
      <ExamSubscriptions />
      <Transactions />
      <WalletHistory />
    </>

    );
  };

const UserExamPage = () => {
    //const [getNextPage, setGetNextPage] = useState('viewSubjectContent');
    return (
      <>
        { <ExamModuleComponent/> }
      </>
    );
  };




  const SubscriptionsPage = () => {
    return (
      <>
        <ExamSubscriptions />
      </>
    );
  };


  return <>
    <div className="App">
      <ActiveItemProvider>
    

        <Routes>
          <>
            <Route element={<Layout />}>
              <Route index element={<HomePage />} />
              <Route path="/about-us" element={<AboutUsPage />} />
              <Route path="/exams" element={<ExamPage />} />
              <Route path="/contact-us" element={<ContactUsPage />} />
              <Route path="/faqs" element={<FaqsPage />} />
            </Route>

            <Route element={<PortalLayout />}>

              <Route path="/user/portal/" exact element={<UserPortal />} />
              <Route path="/user/portal/profile" element={<UserProfile />} />
              <Route path="/user/portal/exam" exact element={<UserExamPage />}/>
              
              <Route path="/user/portal/subscriptions" exact element={<SubscriptionsPage />} />
              <Route path="/user/portal/transactions" element={<Transactions />} />
              <Route path="/user/portal/wallet-history" element={<WalletHistory />} />
             
            </Route>
          </>
          <Route path="/user/login" element={<LoginPage />} />
        </Routes>
      </ActiveItemProvider>
    </div>
  </>
}

export default App;
