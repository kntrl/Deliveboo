const { default: Axios } = require("axios");


var app = new Vue({
    el: "#root",    

    
    data: {
        
        url: "http://127.0.0.1:8000/api/",

        activeRibbon: "selected-pointy",

        crossRightBurgerBar: "untoggle-cross-right",
        crossLeftBurgerBar: "untoggle-cross-left",
        upperBar: "upper-bar",
        lowerBar: "lower-bar",

        toggledSlider: "slider-off",
        category: "",
        restaurants: [],
        categories: [],
    },
    
    methods: {
        getCategories() {
            Axios
                .get("http://127.0.0.1:8000/api/categories")
                .then(response => {
                    const res = response.data.categories;
                    this.categories = res;

                    console.log(this.categories);
                });
        },

        
        selectCategory(category){
        
            this.category = category;
            //console.log(this.category);
            const apiToCall = `${this.url}categories/${category}`;
            Axios
                .get(apiToCall)
                .then(response => {
                    const res = response.data;
                    console.log(res.restaurants);
                    this.topFunction();
                    Vue.set(this.restaurants, 0, res.restaurants);  
                    console.log(this.restaurants[0].length);   
                });

        },


        resetCategory(){
            this.category = "";
        },
        //riporta l'utente in cima alla pagina
        topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        },
        toggleSlider(){
            if (this.toggledSlider === "slider-off") {
                this.toggledSlider = "slider-toggle";
            }
            else{
                this.toggledSlider = "slider-off";
            }
        },
        toggleCrossBurger(){
            // cross on the burger menu when clicking to toggle the slide nav
            if (this.crossRightBurgerBar === "untoggle-cross-right") {
                this.crossRightBurgerBar = "cross-right";
                this.crossLeftBurgerBar = "cross-left";
                //remove the upper and lower bar when cross toggled
                this.upperBar = "invisible-upper-bar";
                this.lowerBar = "invisible-lower-bar";
            }
            else{
                this.crossRightBurgerBar = "untoggle-cross-right";
                this.crossLeftBurgerBar = "untoggle-cross-left";
                //show upper and lower bar
                this.upperBar = "upper-bar";
                this.lowerBar = "lower-bar";
            }

            //slider anim
            if (this.toggledSlider === "slider-off") {
                this.toggledSlider = "slider-toggle";
            }
            else {
                this.toggledSlider = "slider-off";
            }
        },



    },


    mounted(){
        this.getCategories();

        function rand(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }


        
        //GSAP
        gsap.registerPlugin(ScrollTrigger);
        /* V1 */
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: ".main-content",

                //markers: true,
                start: "top center",
            }
        });
        var currentTimeScale = tl.timeScale();
        //sets timeScale to half-speed
        tl.timeScale(2);
        const tl2 = gsap.timeline({
            scrollTrigger: {
                trigger: ".main-content",
                //markers: true,
                start: "top 75%",
            }
        });
        const tl3 = gsap.timeline({
            scrollTrigger: {
                trigger: ".my-wrap",

                scrub: 1,
                start: "15% 10%",
                end: "18%"
            }
        });


        const tl4 = gsap.timeline({repeat: -1});
        tl4.fromTo(".jm-img",
            { scale: 0, ease: "linear" },
            { scale: 1, duration: 1, stagger: .6, ease: "bounce", delay: .5 })
            .to(".jm-img",
                { scale: 0, ease: "linear", stagger: .4, delay: 4, duration: .5});
        
        gsap.fromTo(".milkshake",
            { x: rand(1, 15), y: rand(1, 15), rotation: -5}, { rotation: rand(10, 15), x: rand(1, 15), y: rand(1, 15), repeat: -1, yoyo: true, duration: 4 ,ease: "linear"})
        gsap.fromTo(".panino",
            { x: rand(1, 15), y: rand(1, 15), rotation: -5}, { rotation: rand(10, 15), x: rand(1, 15), y: rand(1, 15), repeat: -1, yoyo: true, duration: 4 ,ease: "linear"}, "<=3")
        gsap.fromTo(".pollo",
            { x: rand(1, 15), y: rand(1, 15), rotation: -5}, { rotation: rand(10, 15), x: rand(1, 15), y: rand(1, 15), repeat: -1, yoyo: true, duration: 3 ,ease: "linear"}, "<=3")
        gsap.fromTo(".ramen",
            { x: rand(1, 15), y: rand(1, 15), rotation: -5}, { rotation: rand(10, 15), x: rand(1, 15), y: rand(1, 15), repeat: -1, yoyo: true, duration: 3 ,ease: "linear"}, "<=3")
        gsap.fromTo(".taco",
            { x: rand(1, 15), y: rand(1, 15), rotation: -5}, { rotation: rand(10, 15), x: rand(1, 15), y: rand(1, 15), repeat: -1, yoyo: true, duration: 5 ,ease: "linear"}, "<=3")
        gsap.fromTo(".uovo",
            { x: rand(1, 15), y: rand(1, 15), rotation: -5}, { rotation: rand(10, 15), x: rand(1, 15), y: rand(1, 15), repeat: -1, yoyo: true, duration: 5 ,ease: "linear"}, "<=3")

        setTimeout(() => {
            tl.from("#row1 div", { y: -50, opacity: 0, stagger: 0.250, duration: 1, ease: "back" })
        }, 500);
        tl2.from("#anim-h2", { y: -50, opacity: 0, duration: .8 })
        tl3.to("#nav-id", { backgroundColor: "#ffffff", boxShadow: "1px 1px 10px grey" })

    },
})


    //`img/avatar${obj.avatar}.jpg`