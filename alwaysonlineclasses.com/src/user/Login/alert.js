
import { React, useEffect } from "react";

import ImportLink from "./ImportLink";

const ShowAlert = ({ message, additionalMessage, alertResult, Icon, onClose }) => {
    if(alertResult===true){
        alertResult="success-div";
        Icon="bi-check-all";
    }else{
        alertResult="warning-div";
        Icon="bi-exclamation-triangle";
    }
    useEffect(() => {
      const timeout = setTimeout(() => {
        onClose(); // Close the success alert after a delay
      }, 3000); // Adjust the delay (in milliseconds) based on your preference
  
      return () => {
        clearTimeout(timeout); // Clear the timeout if the component unmounts before the delay
      };
    }, [onClose]);
  
    return <>
      <ImportLink/>
      <div className="success-div animated bounceInDown" id={alertResult}>
        <div className="icon"><i className={Icon}></i></div>
        {message}<br />
        <span>{additionalMessage}</span>
      </div>
      </>
  };

export default ShowAlert;

