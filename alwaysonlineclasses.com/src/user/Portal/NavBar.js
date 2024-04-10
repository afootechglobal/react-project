


import { React } from "react";
import { Link } from 'react-router-dom';
import logo from './all-images/images/logo.png';
import ImportLink from "./ImportLink";


import SideBar from './SideBar';
import { useActiveItem } from './ActiveItemContext';

const NavBar = ({ setPageTitle }) => {
  const { activeItem, setItem } = useActiveItem();

  const handleLiClick = (title, icon) => {
    setItem(title);
    setPageTitle({ title, icon });
  };

    return <>
      <ImportLink/>

        <div className="header-div">
            <div className="header-div-in">
                <div className="menu-div" title="Open Menu" onclick="_open_menu()" id="menu-div"><i className="fa fa-navicon (alias)"></i></div>

                <div className="logo-div" onClick="_get_page('dashboard','dashboard')"><img src={logo} alt="logo" /></div>

                <h1 className="title-text1">USER PORTAL </h1>

                <div className="nav-div">
                    <Link to="/user/portal"><li id="dashboard" className={activeItem === 'Dashboard' ? 'active-li' : ''} onClick={() => handleLiClick('Dashboard', 'bi-speedometer2')}><i className="bi-speedometer2"></i> Dashboard</li></Link>
                    <Link to="/user/portal/profile"><li id="myprofile" className={activeItem === 'My Profile' ? 'active-li' : ''} onClick={() => handleLiClick('My Profile', 'bi bi-person-square')}><i className="bi bi-person-square"></i> My Profile</li></Link>
                </div>

                <div className="header-profile-pix-div" title="User Account" onclick="_toggle_profile_pix_div()">

                    <div className="img-div" id="option_pix"><img src="" id="passportimg1" alt="Profile image" /></div>


                    <div className="toggle-profile-div">
                        <div className="toggle-profile-pix-div" id="header_pix">
                            <img src="" id="passportimg2" alt="" />
                        </div>

                        <div className="toggle-profile-name"><span id="profile_name">Xxxx</span></div>
                        <div className="toggle-profile-others">User ID: <span id="user_id">STF0000</span> <br /><span id="user_mobile">09021947874</span> </div>
                        <form method="post" action="config/code" name="logoutform">
                            <input type="hidden" name="action" value="logout" />
                            <button className="logout-btn" onclick="" title="Log-Out"><i className="fa fa-sign-out"></i> Log-Out</button>
                        </form>
                        <button className="logout-btn" type="button" title="My Profile" onclick=""><i className="bi-person"></i> Profile</button>

                        <br clear="all" />
                    </div>
                </div>




                <div className="notification" onClick="_get_page('system_alert', 'system_alert')" title="System Alert">
                    <i className="bi-bell"></i>
                </div>



                {/* <span id="_system_alert" ><i className="bi-bell"></i> System Alert</span> */}


            </div>
        </div>
       
        <SideBar setPageTitle={setPageTitle} />

    </>

}
export default NavBar;
























// import { React, useState } from "react";
//  import SideBar from './SideBar';

// import { Link } from 'react-router-dom';
// import logo from './all-images/images/logo.png';


// const NavBar = ({ setPageTitle, resetSidebarActiveItem }) => {
//     const [activeItem, setactiveItem] = useState('Dashboard',);
  
//     const handleLiClick = (title, icon) => {
//       setactiveItem(title);
//       setPageTitle({ title, icon });
//       resetSidebarActiveItem(); // Reset Sidebar active item when a new item is clicked in NavBar
//     };
//     // const [activeItem, setactiveItem] = useState('Dashboard');


//     // const handleLiClick = (title, icon) => {
//     //     setactiveItem(title);
//     //     setPageTitle({ title, icon });
//     // };


//     return <>
//         <div className="header-div">
//             <div className="header-div-in">
//                 <div className="menu-div" title="Open Menu" onclick="_open_menu()" id="menu-div"><i className="fa fa-navicon (alias)"></i></div>

//                 <div className="logo-div" onClick="_get_page('dashboard','dashboard')"><img src={logo} alt="logo" /></div>

//                 <h1 className="title-text1">USER PORTAL </h1>

//                 <div className="nav-div">
//                     <Link to="/user/portal"><li id="dashboard" className={activeItem === 'Dashboard' ? 'active-li' : ''} onClick={() => handleLiClick('Dashboard', 'bi-speedometer2')}><i className="bi-speedometer2"></i> Dashboard</li></Link>
//                     <Link to="/user/portal/profile"><li id="myprofile" className={activeItem === 'My Profile' ? 'active-li' : ''} onClick={() => handleLiClick('My Profile', 'bi bi-person-square')}><i className="bi bi-person-square"></i> My Profile</li></Link>
//                 </div>

//                 <div className="header-profile-pix-div" title="User Account" onclick="_toggle_profile_pix_div()">

//                     <div className="img-div" id="option_pix"><img src="" id="passportimg1" alt="Profile image" /></div>


//                     <div className="toggle-profile-div">
//                         <div className="toggle-profile-pix-div" id="header_pix">
//                             <img src="" id="passportimg2" alt="" />
//                         </div>

//                         <div className="toggle-profile-name"><span id="profile_name">Xxxx</span></div>
//                         <div className="toggle-profile-others">User ID: <span id="user_id">STF0000</span> <br /><span id="user_mobile">09021947874</span> </div>
//                         <form method="post" action="config/code" name="logoutform">
//                             <input type="hidden" name="action" value="logout" />
//                             <button className="logout-btn" onclick="" title="Log-Out"><i className="fa fa-sign-out"></i> Log-Out</button>
//                         </form>
//                         <button className="logout-btn" type="button" title="My Profile" onclick=""><i className="bi-person"></i> Profile</button>

//                         <br clear="all" />
//                     </div>
//                 </div>




//                 <div className="notification" onClick="_get_page('system_alert', 'system_alert')" title="System Alert">
//                     <i className="bi-bell"></i>
//                 </div>



//                 {/* <span id="_system_alert" ><i className="bi-bell"></i> System Alert</span> */}


//             </div>
//         </div>
       
//         <SideBar setPageTitle={setPageTitle} />

//     </>

// }
// export default NavBar;