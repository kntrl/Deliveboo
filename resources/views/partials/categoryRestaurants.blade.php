{{-- RESTAURANT CORRESPONDING TO SELECTED CATEGORY --}}
<div v-else class="restaurants-box">
    <div v-if="!slug.length">
        <div class="">
            {{-- <img src="" alt=""> --}}
            <h1>Ordina @{{category}}</h1>
            {{-- <select v-on:change="selectCategory(category)" v-model="category" id="" name="">
                <option v-for="category in categories">@{{category.name}}</option>
            </select> --}}
        </div>
    
        <div class="double-box">
            {{-- RIBBONS --}}
            <div class="ribbons-box">
                <div v-for="categoria in categories" class="container-ribbon">
                    <span v-on:click="setCategory(categoria.name)" v-bind:class="categoria.name == category ? activeRibbon : ''" class="pointy">@{{categoria.name.charAt(0).toUpperCase() + categoria.name.slice(1)}}</span>
                </div>
            </div>
    
            {{-- RESTAURANTS --}}
            <div class="restaurants-cards-container">
                <div v-if="restaurants[0].length" v-for="(restaurant, index) in restaurants[0]" class="restaurant-card">
                    <h6>@{{restaurant.name}}</h6>
                    <h6>@{{restaurant.address}}</h6>
                    <h6>@{{restaurant.slug}}</h6>
                    <p>@{{(String(restaurant.description).length > 30) ? restaurant.description.slice(0, 30) + "..." : restaurant.description }}</p>
                    
                    {{-- funzione che manda ai piatti del ristorante --}}
                    {{-- chiamata API al menu del ristorante --}}
                    <button v-on:click="getMenu(restaurant.slug)">Menù</button>
                </div>
            </div>
        </div>
    </div>

    
    {{-- SPECIFIC RESTAURANT MENU --}}
    <div v-else>

        <div v-if="!toPayment">
            {{-- menu ristorante e potenziale conferma ordine --}}
            <div v-if="submittedCart">
                <h2 v-if="">@{{restaurantDetails.name}}</h2>
                <div>
                    <form action="">
                        <div v-for="dish in restaurantMenu">
                            <label for="quantity">@{{dish.name}}</label>
                            <p>@{{dish.ingredients}}</p>
                            <label for="quantity">@{{dish.price}}</label>
                            <input v-on:change="setCart(restaurantDetails.slug)"
                                    v-model.number="carrello[restaurantDetails.slug][dish.slug]"
                                    type="number" id="quantity" 
                                    name="quantity" min="0" max="15"
                            >
                        </div>
        
                        <button v-on:click.prevent="submitCart(restaurantDetails.slug)">Go to Checkout</button>
                    </form>
                </div>
            </div>
    
            {{-- inserimento ulteriori informazioni per la consegna dell'ordine --}}
            <div v-else>
                <form action="">
                    <label for="fname">First name:</label><br>
                    <input type="text" id="fname" name="fname" v-model="personalInfo.name"><br>
                    <label for="lname">Last name:</label><br>
                    <input type="text" id="lname" name="lname" v-model="personalInfo.last_name"><br><br>
    
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="" v-model="personalInfo.email"><br>
    
                    <label for="address">Address</label><br>
                    <input type="text" name="" id="" v-model="personalInfo.delivery_address"><br><br>
    
                    <input class="brainClick" v-on:click.prevent="submitPersonalOrderInfo()" type="submit" value="Submit">
                </form> 
            </div>
        </div>

        <div v-else>
            
            <form method="" id="payment-form">
                
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
        
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="btn btn-primary" type="submit"><span>Paga ora</span></button>

                
                <div>
                    <small>Metodo di pagamento sicuro gestito da Braintree</small>
                </div>
            </form>


            

        </div>
    </div>
</div>

{{-- braintree --}}
<script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>

