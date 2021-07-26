
<footer v-if="!category.length">

    <div class="wrapper">
        
        <div class="container">
    
            <div class="row">
           
                <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                    <img src="{{ asset('/img/logo-piccolo-footer.png') }}" alt="Deliveboo small logo">
                </div>
    
                <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                    <h5>Scopri DeliveBoo</h5>
    
                    <ul class="menu">
                        <li>
                            <a href="">Lavora con noi</a>
                        </li>
    
                        <li>
                            <a href="">Negozi patner</a>
                        </li>
    
                        <li>
                            <a href="">Corrieri</a>
                        </li>
    
                        <li>
                            <a href="">Contattaci</a>
                        </li>                       
                        
                    </ul>
    
                </div>
    
                <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                    {{-- <h5>Seguici</h5>
    
                    
                    <ul class="menu">
                        <li>
                            <a href="">Facebook</a>
                        </li>
    
                        <li>
                            <a href="">Instagram</a>
                        </li>
    
                        <li>
                            <a href="">Twitter</a>
                        </li>
                        
                    </ul> --}}
    
                    <h5>Link di interesse</h5>
    
                    
                    <ul class="menu">
                        <li>
                            <a href="">FAQ</a>
                        </li>
    
                        <li>
                            <a href="">Termini e condizioni</a>
                        </li>
    
                        <li>
                            <a href="">Politica sulla privacy</a>
                        </li>
                        
                        <li>
                            <a href="">Politica sui cookie</a>
                        </li>
                    </ul>
                    
                </div>
    
                <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                    <h5>Porta DeliveBoo con te</h5>
    
                    <ul class="menu">
                        <li>
                            <a href="">
                                <img src="{{ asset('/img/app-store-badge.svg') }}" alt="app atore">
                            </a>
                        </li>
    
                        <li>
                            <a href="">
                                <img src="{{ asset('/img/google-play-badge.svg') }}" alt="google play">
                            </a>
                        </li>
    
                        
                    </ul>
                </div>
    
            </div>
    
            {{-- Lower footer --}}
            <div class="small-container">
                
                <div class="lower-footer">                
    
                    <div class="foot-lower-logo">
                        <img src="{{ asset('/img/logo-footer.png') }}" alt="Deliveboo logo">
                    </div>                
    
                    <ul class="social-menu">
                        <li>
                            <a id="social-circle-facebook" href="">F</a>
                        </li>
    
                        <li>
                            <a id="social-circle-twitter" href="">T</a>
                        </li>
    
                        <li>
                            <a id="social-circle-instagram" href="">I</a>
                        </li>
    
                    </ul>   
                    
                </div>            
                
            </div>
            {{-- end Lower footer --}}
    
        </div>

    </div>

</footer>