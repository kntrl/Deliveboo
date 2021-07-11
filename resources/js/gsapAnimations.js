gsap.registerPlugin(ScrollTrigger);


const tl = gsap.timeline({
    scrollTrigger: {
        trigger: ".main-content",
        start: "top center",
    }
});



tl.fromTo(".flexable-container", { y: 100, x: 0, opacity: 0,}, { y: 0, x: 0, opacity: 1, duration: 2,})
