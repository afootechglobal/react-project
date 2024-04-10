
import { React, useState } from 'react';
import { Outlet } from "react-router-dom";


import NavBar from "../Portal/NavBar";
import DashboardUserInfo from "../Portal/DashboardUserInfo";




const Layout = () => {
    const [pageTitle, setPageTitle] = useState({ title: 'Dashboard', icon: 'bi-speedometer2' });
    const [formPopUP, setFormPopUP] = useState(false);
    return (
        <>
            
            <NavBar setPageTitle={setPageTitle} />

            <div className="page-content">
                <div className="page-div-in">
                    <DashboardUserInfo pageTitle={pageTitle} formPopUP={formPopUP}/>
                    <Outlet />
                </div>
            </div>

        </>
    );
};

export default Layout;

