gsap.registerPlugin(ScrollTrigger);

/* V1 */
const tl = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        markers: true,
        start: "top center",
    }
});
tl.from("#row1 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" })
    .from("#row2 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" })
    .from("#row3 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" })








/* V2 */
/* const tl = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        markers: true,
        start: "top center",
    }
});
const tl2 = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        markers: true,
        start: "100px center",
    }
});
const tl3 = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        markers: true,
        start: "200px center",
    }
});

tl.from("#row1 div", {y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease:"back"})
tl2.from("#row2 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" })
tl3.from("#row3 div", { y: 50, opacity: 0, stagger: 0.2, duration: 0.8, ease: "back" }) */

  
  
  
  
  
  
  
  
  //.fromTo("#row1", { y: 100, x: 0, opacity: 0,}, { y: 0, x: 0, opacity: 1, duration: .5,})
  /* .fromTo("#row2", { y: 100, x: 0, opacity: 0, }, { y: 0, x: 0, opacity: 1, duration: .5, })
  .from("#row2 div", { y: 50, stagger: 0.2 })
  .fromTo("#row3", { y: 100, x: 0, opacity: 0, }, { y: 0, x: 0, opacity: 1, duration: .5, })
  .from("#row3 div", { y: 50, stagger: 0.2 })
 */