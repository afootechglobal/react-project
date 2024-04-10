import { React } from "react";
import { useNavigate } from "react-router-dom";
import { MenuItems } from "./ListItems";
import {NavLink} from "react-router-dom";

import logo from '../assets/all-images/images/logo.png';


function Navbar (){ /// if you want to extend the component. 
    const navigate = useNavigate();
 
        return( 
        <section>
        
            <nav className="navbar">

                <header className="header">
                    <div className="header-top-div">
                        <div className="div-in">
                            <div className="contact"><i class="bi-envelope"></i> Info@alwaysonlineclasses@gmail.com</div>
                            <div className="contact phone"><i class="bi-telephone"></i> +234 808 353 3750</div>
                            <ul>
                                <a href="/" target="_blank" title="linkedin">
                                <li class="li"><i class="bi-linkedin"></i></li></a>
                                <a href="/" target="_blank" title="instagram">
                                <li class="li"><i class="bi-instagram"></i></li></a>
                                <a href="/" target="_blank" title="facebook">
                                <li class="li"><i class="bi-facebook"></i></li></a>
                                <a href="/" target="_blank" title="Whatsapp">
                                <li><i class="bi-whatsapp"></i></li></a>
                                <a href="/" title="Call Customer Care">
                                <li><i class="bi-telephone"></i></li></a>
                            </ul>
                        </div>
                    </div>

                    <div className="header-div-in">
                        <div className="inner-div">
                            <div className="logo-div"><img src={logo} alt="logo" /></div>
                            <ul className="nav-menu"> 
                                {MenuItems.map((item, index) =>{
                                    return(
                                        <NavLink to={item.url}>
                                            <li key={index} className={item.cName}>
                                                <i className={item.icon}></i>{item.title}
                                            </li>
                                        </NavLink>
                                    )
                                })}


                            </ul>
                             <button className="mobile-btn" ><i class="bi-list"></i></button>
                       <button className="sign-up" onClick={()=>{navigate("/user/login");}}>SIGN UP / LOGIN</button> 

                        </div>
                    </div>
                </header>
            </nav>
            
        </section>
        )
}

export default Navbar; 