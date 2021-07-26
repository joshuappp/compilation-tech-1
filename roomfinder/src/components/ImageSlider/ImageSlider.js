import React, {useState, useEffect} from 'react';
import {FaArrowAltCircleRight, FaArrowAltCircleLeft}  from 'react-icons/fa';
import classes from './ImageSlider.module.css';

const ImageSlider = (props) => {
    
    const [current, setCurrent] = useState(0);
    const slides = props.slides;
    const length = slides.length;
    
    const prevSlider = () => {
        setCurrent(current === length -1 ? 0 : current + 1);
    }
    const nextSlider = () => {
        setCurrent(current === 0 ? length -1 : current - 1);
    }

    useEffect(() => {
        const timer = setTimeout(() => {
            prevSlider();
        }, 5000);
        return () => clearTimeout(timer);
   });
     
    if(!Array.isArray(slides) || slides.length <=0){
        return null; 
    }

    const sliderData = slides.map((slider,index) => {
        if(index === current){
            return <img src={slider.imageUrl} alt="travel" key={index}/>;
        }
    });

    
    return <div className={classes.ImageSlider}>
                    <div className={classes.ImageSliderCancelButton}>
                        <button onClick={props.clicked}>X</button>
                    </div>
                    <div className={classes.ImageSliderDescription}>
                         <h2>Address: {slides[0].address}</h2>
                    </div>
                    <div className={classes.ImageSliderMiddle}>
                        <div className={classes.ImageSliderContainer}>
                            <FaArrowAltCircleLeft className={classes.leftArrow} onClick={prevSlider} />
                            {sliderData}
                            <FaArrowAltCircleRight className={classes.rightArrow} onClick={nextSlider} />
                        </div>
                    </div>
          </div>;
        
    
}
  
export default ImageSlider;