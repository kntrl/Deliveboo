{{-- RESTAURANT CORRESPONDING TO SELECTED CATEGORY --}}
<div v-else class="restaurants-box">
    <div v-if="submittedInfo == false">
        <button class="previous-page-btn" v-on:click="previousPage()"><i class="fas fa-long-arrow-alt-left" style="font-size: 22px"></i></button>
    </div>

    <div v-if="!slug.length">
        <div class="category-banner-box" v-bind:class="bannerColor">
            <img class="category-banner" v-bind:src="`img/banner_${category}.png`" alt="" >
        </div>
        <div class="media-category-select">
            <button v-on:click="toggleCategoriesSlider()"><i class="fas fa-exchange-alt"></i></button>
        </div>
    
        <div class="double-box">
            {{-- RIBBONS --}}
            <div class="ribbons-box">
                <div v-for="categoria in categories" class="container-ribbon" v-bind:class="toggledCategoriesSlider">
                    <span v-on:click="setCategory(categoria.name)" v-bind:class="categoria.name == category ? activeRibbon : ''" class="pointy">@{{categoria.name.charAt(0).toUpperCase() + categoria.name.slice(1)}}</span>
                </div>
            </div>
            
            

            {{-- RESTAURANTS --}}
            <div class="restaurants-cards-container" v-bind:class="togCardMargin">
                <div v-if="restaurants[0].length" v-for="(restaurant, index) in restaurants[0]" class="restaurant-card" v-on:click="getMenu(restaurant.slug)">
                    <h5>@{{restaurant.name}}</h5>
                    <h5>
                        <span v-for="n in restaurant.vote">
                            <i class="fas fa-star" style="font-size: 13px; color: #f74542"></i>
                        </span>
                    </h5>
                    <h5 style="font-size: 13px; color: grey">@{{restaurant.phone}}</h5>
                    <h6>@{{restaurant.address}}</h6>
                    <ul>
                        <li v-for="item in restaurant.categories">
                            <span>- <b>@{{item.name}}</b></span>
                        </li>
                    </ul>
                    <p>@{{(String(restaurant.description).length > 30) ? restaurant.description.slice(0, 30) + "..." : restaurant.description }}</p>
                    
                    {{-- funzione che manda ai piatti del ristorante --}}
                    {{-- chiamata API al menu del ristorante --}}
                    <button id="hidden-menu-btn">Menù</button>
                </div>
            </div>
        </div>
    </div>

    
    {{-- SPECIFIC RESTAURANT MENU --}}
    <div v-else>

        <div v-if="toPayment == false">
            {{-- menu ristorante e potenziale conferma ordine --}}
            <div v-if="submittedCart == false">
                <div class="category-banner-box" v-bind:class="bannerColor">
                    <img class="category-banner" v-bind:src="`img/banner_${category}.png`" alt="" >
                </div>
                <div class="restaurant-menu-box">
                    <h2 style="margin-top: 12rem" id="restaurant-name">@{{restaurantDetails.name}}</h2>
                    <form action="" id="form-menu">
                        <h4>Antipasti</h4>
                        <hr>
                        <div class="category-course">
                            <div v-for="dish in restaurantMenu" v-if="dish.course == 'Antipasto'" class="dish-info">
                                <h5>@{{dish.name}}</h5>
                                <p><b>Ingredients: </b>@{{dish.ingredients}}</p>
                                <label for="quantity"><b>Price: </b>@{{dish.price}}€</label><br>
                                <div class="allergenic-box">
                                    <span v-if="dish.is_gluten_free"><i class="fas fa-bread-slice"></i></span>
                                    <span v-if="dish.is_hot"><i class="fas fa-pepper-hot"></i></span>
                                    <span v-if="dish.is_vegan"><i class="fas fa-seedling"></i></span>
                                    <span v-if="dish.is_veggy"><i class="fas fa-egg"></i></span>
                                </div>
                                <input 
                                        v-on:change="setCart(restaurantDetails.slug)"
                                        v-model.number="carrello[restaurantDetails.slug][dish.slug]"
                                        type="number" id="quantity" 
                                        name="quantity" min="0" max="15"
                                >
                            </div>
                        </div>

                        <h4>Contorno</h4>
                        <hr>
                        <div class="category-course">
                            <div v-for="dish in restaurantMenu" v-if="dish.course == 'Contorno' || dish.course == 'contorno'" class="dish-info">
                                <h5>@{{dish.name}}</h5>
                                <p><b>Ingredients: </b>@{{dish.ingredients}}</p>
                                <label for="quantity"><b>Price: </b>@{{dish.price}}€</label><br>
                                <div class="allergenic-box">
                                    <span v-if="dish.is_gluten_free"><i class="fas fa-bread-slice"></i></span>
                                    <span v-if="dish.is_hot"><i class="fas fa-pepper-hot"></i></span>
                                    <span v-if="dish.is_vegan"><i class="fas fa-seedling"></i></span>
                                    <span v-if="dish.is_veggy"><i class="fas fa-egg"></i></span>
                                </div>
                                <input 
                                        v-on:change="setCart(restaurantDetails.slug)"
                                        v-model.number="carrello[restaurantDetails.slug][dish.slug]"
                                        type="number" id="quantity" 
                                        name="quantity" min="0" max="15"
                                >
                            </div>
                        </div>

                        <h4>Primi</h4>
                        <hr>
                        <div class="category-course">
                            <div v-for="dish in restaurantMenu" v-if="dish.course == 'Primo' || dish.course == 'primo'" class="dish-info">
                                <h5>@{{dish.name}}</h5>
                                <p><b>Ingredients: </b>@{{dish.ingredients}}</p>
                                <label for="quantity"><b>Price: </b>@{{dish.price}}€</label><br>
                                <div class="allergenic-box">
                                    <span v-if="dish.is_gluten_free"><i class="fas fa-bread-slice"></i></span>
                                    <span v-if="dish.is_hot"><i class="fas fa-pepper-hot"></i></span>
                                    <span v-if="dish.is_vegan"><i class="fas fa-seedling"></i></span>
                                    <span v-if="dish.is_veggy"><i class="fas fa-egg"></i></span>
                                </div>
                                <input 
                                        v-on:change="setCart(restaurantDetails.slug)"
                                        v-model.number="carrello[restaurantDetails.slug][dish.slug]"
                                        type="number" id="quantity" 
                                        name="quantity" min="0" max="15"
                                >
                            </div>
                        </div>

                        <h4>Secondi</h4>
                        <hr>
                        <div class="category-course">
                            <div v-for="dish in restaurantMenu" v-if="dish.course == 'Secondo' || dish.course == 'secondo'" class="dish-info">
                                <h5>@{{dish.name}}</h5>
                                <p><b>Ingredients: </b>@{{dish.ingredients}}</p>
                                <label for="quantity"><b>Price: </b>@{{dish.price}}€</label><br>
                                <div class="allergenic-box">
                                    <span v-if="dish.is_gluten_free"><i class="fas fa-bread-slice"></i></span>
                                    <span v-if="dish.is_hot"><i class="fas fa-pepper-hot"></i></span>
                                    <span v-if="dish.is_vegan"><i class="fas fa-seedling"></i></span>
                                    <span v-if="dish.is_veggy"><i class="fas fa-egg"></i></span>
                                </div>
                                <input 
                                        v-on:change="setCart(restaurantDetails.slug)"
                                        v-model.number="carrello[restaurantDetails.slug][dish.slug]"
                                        type="number" id="quantity" 
                                        name="quantity" min="0" max="15"
                                >
                            </div>
                        </div>
                        <h4>Dolci</h4>
                        <hr>
                        <div class="category-course">
                            <div v-for="dish in restaurantMenu" v-if="dish.course == 'Dolce'" class="dish-info">
                                <h5>@{{dish.name}}</h5>
                                <p><b>Ingredients: </b>@{{dish.ingredients}}</p>
                                <label for="quantity"><b>Price: </b>@{{dish.price}}€</label><br>
                                <div class="allergenic-box">
                                    <span v-if="dish.is_gluten_free"><i class="fas fa-bread-slice"></i></span>
                                    <span v-if="dish.is_hot"><i class="fas fa-pepper-hot"></i></span>
                                    <span v-if="dish.is_vegan"><i class="fas fa-seedling"></i></span>
                                    <span v-if="dish.is_veggy"><i class="fas fa-egg"></i></span>
                                </div>
                                <input 
                                        v-on:change="setCart(restaurantDetails.slug)"
                                        v-model.number="carrello[restaurantDetails.slug][dish.slug]"
                                        type="number" id="quantity" 
                                        name="quantity" min="0" max="15"
                                >
                            </div>
                        </div>
                        
                        <h4>Bevande</h4>
                        <hr>
                        <div class="category-course">
                            <div v-for="dish in restaurantMenu" v-if="dish.course == 'Bevande'" class="dish-info">
                                <h5>@{{dish.name}}</h5>
                                <p><b>Ingredients: </b>@{{dish.ingredients}}</p>
                                <label for="quantity"><b>Price: </b>@{{dish.price}}€</label><br>
                                <div class="allergenic-box">
                                    <span v-if="dish.is_gluten_free"><i class="fas fa-bread-slice"></i></span>
                                    <span v-if="dish.is_hot"><i class="fas fa-pepper-hot"></i></span>
                                    <span v-if="dish.is_vegan"><i class="fas fa-seedling"></i></span>
                                    <span v-if="dish.is_veggy"><i class="fas fa-egg"></i></span>
                                </div>
                                <input 
                                        v-on:change="setCart(restaurantDetails.slug)"
                                        v-model.number="carrello[restaurantDetails.slug][dish.slug]"
                                        type="number" id="quantity" 
                                        name="quantity" min="0" max="15"
                                >
                            </div>
                        </div>
                    </form>
                    <button v-on:click.prevent="submitCart(restaurantDetails.slug)">Order Now</button>
                </div>
            </div>
    
            {{-- inserimento ulteriori informazioni per la consegna dell'ordine --}}
            <div v-else id="shipping-info-box">
                <form action="">
                    <label for="fname">First name:</label>
                    <input type="text" id="fname" name="fname" v-model="personalInfo.name" >
                    <label for="lname">Last name:</label>
                    <input type="text" id="lname" name="lname" v-model="personalInfo.last_name" >
    
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="" v-model="personalInfo.email" >
    
                    <label for="address">Address</label>
                    <input type="text" name="" id="" v-model="personalInfo.delivery_address">

                    <label for="address">Phone</label>
                    <input type="number" name="" id="" v-model="personalInfo.phone" max="10">
    
                    <input id="button-input" class="brainClick" v-on:click.prevent="submitPersonalOrderInfo()" type="submit" value="Order Now">
                </form> 
            </div>
        </div>

        <div v-else>
            <div v-if="orderPaid == false" class="final-page">
                <div class="order-recap">
                    <h3>ORDER RECAP</h3>
                    <ul>
                        <li>
                            <span>Address: @{{this.orderRecap.delivery_address}}</span>
                        </li>

                        <li>
                            <span>Email: @{{this.orderRecap.email}}</span>
                        </li>

                        <li>
                            <span>Name: @{{this.orderRecap.name}}</span>
                        </li>

                        <li>
                            <span>Lastname: @{{this.orderRecap.last_name}}</span>
                        </li>

                        <li>
                            <span>Phone: @{{this.orderRecap.phone}}</span>
                        </li>

                        <hr>
                        <li>
                            <ul>
                                <li v-for="(food, index) in this.orderRecap.foods">
                                    <span>
                                        <b>@{{food.pivot.quantity}}</b> @{{food.name}} | @{{(parseFloat(food.price) * parseFloat(food.pivot.quantity)).toFixed(2)}}€
                                    </span> 

                                </li>
                            </ul>
                        </li>
                        <hr>

                        <li>
                            <span>Total price: @{{this.totalPrice}}€</span>
                        </li>
                    </ul>
                    
                </div>
                {{-- BRAINTREE PAYMENT FORM --}}
                <div id="braintree-box">
                    <form method="" id="payment-form">
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                
                        <input id="nonce" name="payment_method_nonce" type="hidden" required/>
                        <button v-on:click="goHome()" v-if="payButton" id="braintree-btn" type="submit"><span>Pay Now</span></button>
                        
                        <button id="back-to-home" v-if="payButton == false" v-on:click.prevent="clearStorage()">HOMEPAGE</button>

                        <div>
                            <small>Metodo di pagamento sicuro gestito da Braintree</small>
                        </div>
                    </form>
                </div>

            </div>
            
            <div v-else id="incoming-delivery">
                <h2>IL TUO ORDINE STA ARRIVANDO!</h2>
            </div>
        </div>
    </div>
</div>

{{-- braintree --}}
<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>

