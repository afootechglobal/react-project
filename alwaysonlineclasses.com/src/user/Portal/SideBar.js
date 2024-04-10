
import { React} from 'react';
import { Link, useNavigate } from 'react-router-dom';
import logo from './all-images/images/logo.png';
import { useActiveItem } from './ActiveItemContext';


const SideBar = ({ setPageTitle }) => {
  const navigate = useNavigate();

  const { activeItem, setItem } = useActiveItem();

  const handleLiClick = (title, icon) => {
      setItem(title);
      setPageTitle({ title, icon });
  };

  const logoutSubmit = () => {
    sessionStorage.removeItem('userLoginSession');
    navigate('/user/login');
  };




  return (
    <>
    <div className="side-back-div " id="menu-list-div">
      <div className="div-in">
        <div className="logo-div"><img src={logo} alt="logo" /></div>
        <br clear="all" />
        <br clear="all" />
        <div className="side-link">
          <Link to="/user/portal"><li id="dashboard" className={activeItem === 'Dashboard' ? 'active-li' : ''} onClick={() => handleLiClick('Dashboard', 'bi-speedometer2')} ><i className="bi-speedometer2"></i> Dashboard</li></Link >
          <Link to="/user/portal/exam"><li id="exam" className={activeItem === 'Exam / Videos' ? 'active-li' : ''} onClick={() => handleLiClick('Exam / Videos', 'bi-pencil-square')}><i className="bi-pencil-square"></i> Exam / Videos</li></Link >
          <Link to="/user/portal/subscriptions"><li id="Subscriptions" className={activeItem === 'Subcriptions' ? 'active-li' : ''} onClick={() => handleLiClick('Subcriptions', 'bi-box-arrow-in-up-right')}><i className="bi-box-arrow-in-up-right"></i> Subcription</li></Link>
          <Link to="/user/portal/transactions"><li id="Transactions" className={activeItem === 'Transactions' ? 'active-li' : ''} onClick={() => handleLiClick('Transactions', 'bi-credit-card')}><i className="bi-credit-card"></i> Transactions</li></Link >
          <Link to="/user/portal/wallet-history"><li id="wallet-history" className={activeItem === 'Wallet History' ? 'active-li' : ''} onClick={() => handleLiClick('Wallet History', 'bi-credit-card')}><i className="bi-credit-card"></i> Wallet History</li></Link >
        </div>
      </div>

      <div className="div-in side-bottom">
        <div className="side-link">
          <li ><i className="bi bi-gear"></i> Settings</li>
          <li type="submit" onClick={logoutSubmit}><i className="bi bi-power"></i> Log-Out</li>
        </div>
      </div>

    </div>
    </>
  );
};

export default SideBar;




























// import { React, useState } from 'react';
// import { Link, useNavigate } from 'react-router-dom';
// import logo from './all-images/images/logo.png';



// const SideBar = ({ setPageTitle, resetSidebarActiveItem }) => {

//   const [activeItem, setactiveItem] = useState('Dashboard');

//   const handleLiClick = (title, icon) => {
//     setactiveItem(title);
//     setPageTitle({ title, icon });
//     resetSidebarActiveItem()
//   };
//   const navigate = useNavigate();


//   const logoutSubmit = () => {
//     sessionStorage.removeItem('userLoginSession');
//     navigate('/user/login');
//   };







//   return (
//     <>
//     <div className="side-back-div " id="menu-list-div">
//       <div className="div-in">
//         <div className="logo-div"><img src={logo} alt="logo" /></div>
//         <br clear="all" />
//         <br clear="all" />
//         <div className="side-link">
//           <Link to="/user/portal"><li id="dashboard" className={activeItem === 'Dashboard' ? 'active-li' : ''} onClick={() => handleLiClick('Dashboard', 'bi-speedometer2')} ><i className="bi-speedometer2"></i> Dashboard</li></Link >
//           <Link to="/user/portal/exam"><li id="exam" className={activeItem === 'Exam / Videos' ? 'active-li' : ''} onClick={() => handleLiClick('Exam / Videos', 'bi-pencil-square')}><i className="bi-pencil-square"></i> Exam / Videos</li></Link >
//           <Link to="/user/portal/subscriptions"><li id="Subscriptions" className={activeItem === 'Subcriptions' ? 'active-li' : ''} onClick={() => handleLiClick('Subcriptions', 'bi-box-arrow-in-up-right')}><i className="bi-box-arrow-in-up-right"></i> Subcription</li></Link>
//           <Link to="/user/portal/transactions"><li id="Transactions" className={activeItem === 'Transactions' ? 'active-li' : ''} onClick={() => handleLiClick('Transactions', 'bi-credit-card')}><i className="bi-credit-card"></i> Transactions</li></Link >
//           <Link to="/user/portal/wallet-history"><li id="wallet-history" className={activeItem === 'Wallet History' ? 'active-li' : ''} onClick={() => handleLiClick('Wallet History', 'bi-credit-card')}><i className="bi-credit-card"></i> Wallet History</li></Link >
//         </div>
//       </div>

//       <div className="div-in side-bottom">
//         <div className="side-link">
//           <li ><i className="bi bi-gear"></i> Settings</li>
//           <li type="submit" onClick={logoutSubmit}><i className="bi bi-power"></i> Log-Out</li>
//         </div>
//       </div>

//     </div>
//     </>
//   );
// };

// export default SideBar;
