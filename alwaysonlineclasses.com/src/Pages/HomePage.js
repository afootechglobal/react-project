import { React,useEffect } from "react";
import ImportLink from './ImportLink';
import Slide from './slide';


import slide_image from '../assets/all-images/body-pix/content-image1.jpg';
import waec from '../assets/all-images/body-pix/waec.png';
import ijmb from '../assets/all-images/body-pix/ijmb.png';

const HomePage = () => {
    <ImportLink/>


       
 

    return (
        <>
            {/* <Navbar /> */}

            <Slide
                slide_pix={slide_image}
                title={"Embrace Learning Anytime with Always Online classNamees!"}
                description="Access high-quality education from anywhere, at any time. Explore a wide range of subjects and courses delivered through virtual platforms on SSCE, GCE, NABTEB."
                url="/"
                buttontext="JOIN US NOW"
            />



            <section className="index-content-div">

                <section className="body-div">
                    <div className="body-div-in categories-back-div">
                        <div className="title-div" >
                            <p>--Our Services--</p>
                            <h3>Our Exams Categories </h3>
                        </div>

                        <div className="categories-div">
                            <div className="image-div">
                                <img src={waec} alt="topics" />
                            </div>

                            <div className="text-div">
                                <h3>WAEC</h3>
                            </div>
                        </div>

                        <div className="categories-div">
                            <div className="image-div">
                                <img src={ijmb} alt="topics" />
                            </div>

                            <div className="text-div">
                                <h3>IJMB</h3>
                            </div>
                        </div>



                        <div className="categories-div">
                            <div className="image-div">
                                <img src={waec} alt="topics" />
                            </div>

                            <div className="text-div">
                                <h3>WAEC</h3>
                            </div>
                        </div>


                        <div className="categories-div">
                            <div className="image-div">
                                <img src={ijmb} alt="topics" />
                            </div>

                            <div className="text-div">
                                <h3>IJMB</h3>
                            </div>
                        </div>

                    </div>
                    <br clear="all" />
                    <br clear="all" />
                </section>









                <section className="body-div">
                    <div className="body-div-in categories-back-div">
                        <div className="title-div" data-aos="zoom-in" data-aos-duration="1000">
                            <p>--What We Offer-- </p>
                            <h3>Our Popular Subjects</h3>
                        </div>

                        <div className="subject-back-div">

                            <div className="subject-div">
                                <div className="image-div">
                                    <div className="img-in">
                                        <img src="<?php// echo $website_url?>/all-images/body-pix/maths.jpg" alt="maths" />
                                    </div>
                                </div>

                                <div className="sub-title-div">
                                    Subject
                                </div>

                                <div className="text-div">
                                    <h3>MATHEMATICS</h3>
                                    <hr></hr>
                                    <span className="text"><i className="bi-book"></i> Topics: 599</span>
                                    <a href="<?php// echo $website_url ?>/exams/waec/mathematics/" title="Mathematics">
                                        <button className="btn" title="Read More">Read More<i className="bi-arrow-right"></i></button></a>
                                </div>
                            </div>

                            <div className="subject-div">
                                <div className="image-div">
                                    <div className="img-in">
                                        <img src="<?php// echo $website_url?>/all-images/body-pix/maths.jpg" alt="maths" />
                                    </div>
                                </div>

                                <div className="sub-title-div">
                                    Subject
                                </div>

                                <div className="text-div">
                                    <h3>MATHEMATICS</h3>
                                    <hr></hr>
                                    <span className="text"><i className="bi-book"></i> Topics: 599</span>
                                    <a href="<?php// echo $website_url ?>/exams/waec/mathematics/" title="Mathematics">
                                        <button className="btn" title="Read More">Read More<i className="bi-arrow-right"></i></button></a>
                                </div>
                            </div>



                            <div className="subject-div">
                                <div className="image-div">
                                    <div className="img-in">
                                        <img src="<?php// echo $website_url?>/all-images/body-pix/maths.jpg" alt="maths" />
                                    </div>
                                </div>

                                <div className="sub-title-div">
                                    Subject
                                </div>

                                <div className="text-div">
                                    <h3>MATHEMATICS</h3>
                                    <hr></hr>
                                    <span className="text"><i className="bi-book"></i> Topics: 599</span>
                                    <a href="<?php// echo $website_url ?>/exams/waec/mathematics/" title="Mathematics">
                                        <button className="btn" title="Read More">Read More<i className="bi-arrow-right"></i></button></a>
                                </div>
                            </div>



                            <div className="subject-div">
                                <div className="image-div">
                                    <div className="img-in">
                                        <img src="<?php// echo $website_url?>/all-images/body-pix/maths.jpg" alt="maths" />
                                    </div>
                                </div>

                                <div className="sub-title-div">
                                    Subject
                                </div>

                                <div className="text-div">
                                    <h3>MATHEMATICS</h3>
                                    <hr></hr>
                                    <span className="text"><i className="bi-book"></i> Topics: 599</span>
                                    <a href="<?php// echo $website_url ?>/exams/waec/mathematics/" title="Mathematics">
                                        <button className="btn" title="Read More">Read More<i className="bi-arrow-right"></i></button></a>
                                </div>
                            </div>





                        </div>






                    </div>
                    <br clear="all" />
                    <br clear="all" />
                </section>















            </section>

        </>

    )
}

export default HomePage;