const { default: Axios } = require("axios");


var app = new Vue({
    el: "#root",    

    
    data: {
        
        url: "http://127.0.0.1:8000/api/",

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
            const apiToCall = `${this.url}categories/${category}`;
            this.category = category;
            Axios
                .get(apiToCall)
                .then(response => {
                    this.topFunction();
                    const res = response.data;
                    Vue.set(this.restaurants, 0, res);
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
        setTimeout(() => {
            tl.from("#row1 div", { y: -50, opacity: 0, stagger: 0.250, duration: 1, ease: "back" })
        }, 500);
        tl2.from("#anim-h2", { y: -50, opacity: 0, duration: .8 })
        tl3.to("#nav-id", { backgroundColor: "#ffffff", boxShadow: "1px 1px 10px grey" })
    },
})


    //`img/avatar${obj.avatar}.jpg`