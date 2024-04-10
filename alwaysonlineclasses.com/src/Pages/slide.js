import { countitems } from "./ListItems";

const  slide_pix_alt = "Alwaysonlineclasses Image";
function Slide (props){
    return (
        <>

    <div className="slide-div">
        <div className="image-bg">
            <div className="content-back-div">
                <div className="content-div-in">

                        <div className="image-content-div">
                            <div className="div-in">
                                <img src={props.slide_pix} alt={slide_pix_alt.slide_pix}/>
                            </div> 
                        </div>
                            <div className="image-content-div text-content-div">
                                <div className="inner-div">
                                    <h1>{props.title}</h1>
                                    <p>{props.description}</p>
                                    <a href={props.url} title="JOIN US NOW">
                                    <button className="sign-up" title={props.buttontext}>{props.buttontext}</button></a>
                                </div>
                            </div>


                        <div className="image-content-div count-div">
                            {countitems.map((item, index) =>{
                                    return(
                                <div className="count-div-in" key={index}>
                                    <div className="img-div">
                                        <img src={item.image} alt={item.image}/>
                                    </div>

                                    <div className="text-div">
                                        <h2>{item.count}</h2>
                                        {item.text}
                                    </div>               
                                </div>
                                )
                            })}
                       
                        </div>



                
                 </div>
            </div>
        </div>
    </div>

            





        </>
        
    )
}

export default Slide;