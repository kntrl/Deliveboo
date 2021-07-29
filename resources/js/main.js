const { default: Axios } = require("axios");
const { isSet, functionsIn } = require("lodash");

var app = new Vue({
    el: "#root",    

    data: {
        
        /* style data */
        activeRibbon: "selected-pointy",
        crossRightBurgerBar: "untoggle-cross-right",
        crossLeftBurgerBar: "untoggle-cross-left",
        upperBar: "upper-bar",
        lowerBar: "lower-bar",
        toggledSlider: "slider-off",
        toggledCategoriesSlider: "",
        togCardMargin: "",
        transitionClass: "transition-page-left",
        isHomePage: true,
        menuPage : false,
        bannerColor : "",


        /* navigation data */
        url: "http://127.0.0.1:8000/api/",
        category: "",
        slug: "",
        restaurants: [],
        categories: [],
        restaurantDetails : {},
        restaurantMenu : [],
        orderPaid : false,
        payButton: true,


        /* communication data */
        submittedInfo : false,
        carrello : {},
        toPayment: false,
        submittedCart : false,
        foods: [],
        cartToPay : {},
        personalInfo : {
            "name": "",
            "last_name": "",
            "email": "",
            "delivery_address" : "",
            "phone" : "",
        },
        orderDetails: {},
        backResponse : {},
        clientToken: "",

        orderResponse : {},
        orderRecap : {},
        totalPrice : "",
    },
    
    methods: {
        /* communication functions */
        goHome(){
            console.log("ciao ora torno alla homepage")
            
            setTimeout(() => {
                this.payButton = false;
            }, 1000);  
        },
        clearStorage(){
            setTimeout(() => {
                this.orderPaid = true;
                localStorage.clear();
                /* this.isWhatPage(); */
            }, 500);
            setTimeout(() => {
                this.orderRecap = {};
                window.location.reload();
            }, 3000);
        },
        submitPersonalOrderInfo(){
            if (this.personalInfo["name"] != "" && 
                this.personalInfo["last_name"] != "" && 
                this.personalInfo["email"] != "" && 
                this.personalInfo["delivery_address"] != "" &&
                this.personalInfo["phone"] != "") {
                
                    
                    this.submittedInfo = true;
                    this.toPayment = true;
                    this.personalInfo = { 
                                        ...this.personalInfo,
                                        "order": this.orderDetails
                                        }
                    //console.log(this.personalInfo);
                    this.frontToBack();
            }
            else{
                //da convertire con un MODAL
                alert("All fields are required!")
            }

        },
        frontToBack(){
            const data = JSON.stringify(this.personalInfo);
            const config = {
                "method": "post",
                'url': 'http://127.0.0.1:8000/api/orders/validate-order',
                "headers": {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                "data": data
            }
            Axios(config)
                .then((response) => {
                    const res = JSON.stringify(response.data);
                    this.backResponse = JSON.parse(res);
                    this.clientToken = this.backResponse.data.clientToken;

                    //QUESTI SONO I DATI PER IL RIEPILOGO ORDINE
                    console.log("order data to show for recap", this.backResponse.data.order);
                    this.orderRecap = this.backResponse.data.order;
                    this.totalPrice = (this.orderRecap.price).toFixed(2);
                    console.log("order data to show for recap", this.orderRecap);
                    this.brainTreeFunction(this.backResponse.data.order.id);
                    
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        brainTreeFunction(orderID) {
            var form = document.querySelector('#payment-form');
            braintree.dropin.create({
                authorization: this.clientToken,
                selector: '#bt-dropin',
                paypal: {
                    flow: 'vault'
                }
            }, function (createErr, instance) {
                if (createErr) {
                    console.log('Create Error', createErr);
                    return;
                }
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            console.log('Request Payment Method Error', err);
                            return;
                        }
                        // Add the nonce to the form and submit

                        document.querySelector('#nonce').value = payload.nonce;


                        const toBack =
                        {
                            "order_id": orderID,
                            "nonceFromTheClient": payload.nonce,
                        }
                        const config = {
                            "method": "post",
                            'url': 'http://127.0.0.1:8000/api/orders/create-transaction',
                            "headers": {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            "data": toBack
                        }

                        //stampa la risposta da brain tree
                        Axios(config)
                            .then((response) => {
                                console.log(response.data);
                            });
                    });
                });
            });
        },
        submitPersonalOrderInfo(){
            //console.log(this.personalInfo);
            this.toPayment = true;
            //this.personalInfo.phone = parseInt(this.personalInfo.phone);
            this.personalInfo = { 
                                ...this.personalInfo,
                                "order": this.orderDetails
                                }
            console.log(this.personalInfo);
            this.frontToBack();
        },
        submitCart(restaurantSlug){
            /* this.isWhatPage(); */
            setTimeout(() => {
                this.submittedCart = true;
            }, 500);
            this.isWhatPage();
            this.cartToPay = this.carrello[restaurantSlug];
            //console.log("sono cart to pay", this.cartToPay);
            const apiToCall = `${this.url}restaurants/${restaurantSlug}`;
            Axios
                .get(apiToCall)
                .then(response => {
                    this.topFunction();
                    const res = response.data;
                    //console.log("sono res.foods", res.restaurant.foods);

                    for (const iterator of res.restaurant.foods) {
                        //console.log(iterator);
                        if (this.cartToPay[iterator.slug]) {
                            this.foods.push(
                                {
                                    "id": iterator.id,
                                    "name" : iterator.name,
                                    "quantity" : this.cartToPay[iterator.slug],
                                }
                            );
                        }
                    }
                    this.orderDetails = {
                        "restaurant" : restaurantSlug,
                        "foods" : this.foods,
                    }
                });
        },
        setCart(restaurantSlug){
            localStorage.setItem("carrello", JSON.stringify(this.carrello));
            this.setCartData(restaurantSlug);
        },
        setCartData(restaurantSlug){
            let tempCart = JSON.parse(localStorage.getItem("carrello"));
            this.carrello[restaurantSlug] = tempCart[restaurantSlug];
            //console.log(this.carrello)
        },
        getCategories() {
            Axios
                .get("http://127.0.0.1:8000/api/categories")
                .then(response => {
                    const res = response.data.categories;
                    console.log(res);
                    this.categories = res;
                });
        },
        setCategory(category){
            if (this.isHomePage == true) {
                this.isWhatPage();
                setTimeout(() => {
                    this.isHomePage = false;
                    this.menuPage = true;
                    this.category = category;
                    const apiToCall = `${this.url}categories/${category}`;
                    this.toggleCategoriesSlider();
                    Axios
                        .get(apiToCall)
                        .then(response => {
                            const res = response.data;
                            this.topFunction();
                            Vue.set(this.restaurants, 0, res.restaurants);
                            console.log(this.restaurants);
                            this.pickBannerColor(category);
                        })
                        .catch(error => {
                            console.log("ERRORE");
                            if (error.response) {
                                Vue.set(this.restaurants, 0, []);
                            } else if (error.request) {
                                Vue.set(this.restaurants, 0, []);
                            } else {
                                Vue.set(this.restaurants, 0, []);
                            }
                        })
                }, 500);
            }
            else{
                this.category = category;   
                const apiToCall = `${this.url}categories/${category}`;
                this.toggleCategoriesSlider();
                Axios
                    .get(apiToCall)
                    .then(response => {
                        const res = response.data;
                        this.topFunction();
                        Vue.set(this.restaurants, 0, res.restaurants);
                        this.pickBannerColor(category);
                        //console.log(this.restaurants);
                    })
                    .catch( error => {
                        console.log("ERRORE");
                        if (error.response) {
                            Vue.set(this.restaurants, 0, []);
                        } else if (error.request) {
                            Vue.set(this.restaurants, 0, []);
                        } else {
                            Vue.set(this.restaurants, 0, []);
                        }
                    })
            }
        },
        getMenu(slug){
            this.isWhatPage();
            setTimeout(() => {
                this.slug = slug;
                const apiToCall = `${this.url}restaurants/${slug}`;
                Axios
                    .get(apiToCall)
                    .then(response => {
                        const res = response.data;
                        this.restaurantDetails = res.restaurant;
                        this.restaurantMenu = this.restaurantDetails.foods;
                        if (!this.carrello[slug]) {
                            this.carrello[slug] = {}; 
                            for (const iterator of this.restaurantMenu) {              
                                this.carrello[slug] = { 
                                                       ...this.carrello[slug], 
                                                       [iterator.slug] : 0
                                                       };
                            }
                        }
                        console.log(this.restaurantMenu);
                    });
            }, 500);
        },
        /* frontend functionality */
        previousPage(){
            if (this.toPayment == true){
                this.personalInfo = {
                    "name": "",
                    "last_name": "",
                    "email": "",
                    "delivery_address" : "",
                }
                this.toPayment = false;
            }
            else if (this.submittedCart) {
                this.submittedCart = false;
            }
            else if (this.category.length && this.slug.length){
                this.slug = "";
            }
            else if (this.category.length) {
                this.menuPage = false;
                this.isHomePage = true;
                this.category = "";
            }
        },
        /* style functions */
        resetCategoryAndSlug(){
            this.category = "";
            this.slug = "";
        },
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
            this.sliderOnOff();
        },
        sliderOnOff(){
            //slider anim
            if (this.toggledSlider === "slider-off") {
                this.toggledSlider = "slider-toggle";
            }
            else {
                this.toggledSlider = "slider-off";
            }
        },
        toggleCategoriesSlider(){
            this.toggledCategoriesSlider == "" ? this.toggledCategoriesSlider = "toggled-cat-slider" : this.toggledCategoriesSlider = "";
            this.togCardMargin == "" ? this.togCardMargin = "toggled-cards-margin" : this.togCardMargin = "";

        },
        animatePageTransition(){
            if (this.transitionClass == "transition-page-right") {
                this.transitionClass = "transition-page-left";
            }
            else if (this.transitionClass == "transition-page-left"){
                this.transitionClass = "transition-page-right";
            }    
        },
        isWhatPage(){
            if (this.isHomePage == true && this.menuPage == false) {
                this.animatePageTransition();
            }
            else if (this.menuPage == true && this.isHomePage == false) {
                this.animatePageTransition();
            }
            else if (this.submittedCart == true){
                this.animatePageTransition();
            }
            else if (this.orderPaid == true){
                this.animatePageTransition();
            }
        },
        pickBannerColor(category){
            switch (category) {
                case "italiano":
                    this.bannerColor = "italiano"               
                    break;
                case "cinese":
                    this.bannerColor = "cinese"
                    break;
                case "indiano":
                    this.bannerColor = "indiano"
                    break;
                case "hamburger":
                    this.bannerColor = "hamburger"
                    break;
                case "pizza":
                    this.bannerColor = "pizza"
                    break;
                case "libanese":
                    this.bannerColor = "libanese"
                    break;
                case "americano":
                    this.bannerColor = "americano"
                    break;
                case "sushi":
                    this.bannerColor = "sushi"
                    break;
                case "vegano":
                    this.bannerColor = "vegano"
                    break;
                case "messicano":
                    this.bannerColor = "messicano"
                    break;
                case "kebab":
                    this.bannerColor = "kebab"
                    break;
                case "hawaiano":
                    this.bannerColor = "hawaiano"
                    break;    
            }
        }
    },

    mounted(){
        //
        let storedData = JSON.parse(localStorage.getItem("carrello"));
        if (storedData) {
            this.carrello = storedData;
            //console.log(this.carrello);
        }

        this.getCategories()

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
