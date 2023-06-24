
    @include('frontend.partials.js')
    <div class="lightboxContainer">
        
    </div>

    <div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 
            </div>
            <div class="modal-body">
                <div class="phoneNumberLogin authForm">
                    <div>
                       <div class="facebookLogin">
                          <button class="facebookLoginButton loginBtn loginButton">
                             <svg width="20px" height="20px" style="fill:white;stroke:white;display:inline-block;vertical-align:middle;" viewBox="0 0 430.113 430.114">
                                <path id="Facebook" d="M158.081,83.3c0,10.839,0,59.218,0,59.218h-43.385v72.412h43.385v215.183h89.122V214.936h59.805 c0,0,5.601-34.721,8.316-72.685c-7.784,0-67.784,0-67.784,0s0-42.127,0-49.511c0-7.4,9.717-17.354,19.321-17.354 c9.586,0,29.818,0,48.557,0c0-9.859,0-43.924,0-75.385c-25.016,0-53.476,0-66.021,0C155.878-0.004,158.081,72.48,158.081,83.3z"></path>
                             </svg>
                             <div class="buttonText"><span>Sign Up or Login with <b>Facebook</b></span></div>
                          </button>
                       </div>
                    </div>
                    <button class="loginBtn emailLoginBtn">
                       <i class="fab fa-google"></i>
                       <span>Login with <b>Google</b></span>
                    </button>
                    <div class="orContainer"><span>or</span></div>
                    <div class="loginWithPhoneMessage d-none">PLEASE ENTER YOUR MOBILE PHONE NUMBER</div>
                    <form method="POST" action="{{ route('front.login') }}" id="ajaxForm">
                    @csrf
                    <div class="phoneNumberInputContainer d-none">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="tel" value="+88" class="form-control rounded-0 shadow-none border-none" placeholder="e.g. +8801672955886">
                             </div>
                          </div>
                       </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="email" name="email" class="form-control rounded-0 shadow-none border-none" placeholder="example@example.com">
                             </div>
                          </div>
                       </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="password" name="password" class="form-control rounded-0 shadow-none border-none" placeholder="Enter your password">
                             </div>
                          </div>
                       </div>
                       <div class="errorContainer"></div>
                       <div class="actions"><button class="loginBtn" type="submit">LOGIN</button></div>
                    </form>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#signup">Not yet registered? SIGN UP</button>
                 </div>
            </div>
        </div>
    </div>
 </div>    
 <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Create An Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 
            </div>
            <div class="modal-body">
                <div class="phoneNumberLogin authForm">
                    <form method="POST" action="{{ route('front.register') }}" id="ajaxForm">
                    @csrf
                    <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="text" name="name" class="form-control rounded-0 shadow-none border-none" placeholder="Your Name">
                             </div>
                          </div>
                       </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="email" name="email" class="form-control rounded-0 shadow-none border-none" placeholder="example@example.com">
                             </div>
                          </div>
                       </div>                         
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="text" name="phone" class="form-control rounded-0 shadow-none border-none" placeholder="017xxxxxxxxxx">
                             </div>
                          </div>
                       </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="password" name="password" class="form-control rounded-0 shadow-none border-none" placeholder="Enter your password">
                             </div>
                          </div>
                       </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="password" name="password_confirmation" class="form-control rounded-0 shadow-none border-none" placeholder="Re-type your password">
                             </div>
                          </div>
                       </div>
                       <div class="errorContainer"></div>
                       <div class="actions"><button class="loginBtn" type="submit">REGISTER</button></div>
                    </form>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#signin">Already have an account? LOGIN</button>
                 </div>
            </div>
        </div>
    </div>
 </div> 
 <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Your Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 
            </div>
            <div class="modal-body">
                <div class="phoneNumberLogin authForm">
                    <form method="POST" action="{{ route('front.profile.update') }}" id="ajaxForm" enctype="multipart/form-data">
                    @csrf
                    @auth
                    <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                            <div align="center">
                                <img src="{{ asset(auth()->user()->image) }}" id="previewImg" alt="" height="100" width="100">
                            </div>
                             <div class="input">
                                <input type="file" name="image" class="form-control rounded-0 shadow-none border-none" >
                             </div>
                          </div>
                        </div>                           
                        <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="text" value="{{ auth()->user()->name }}" name="name" class="form-control rounded-0 shadow-none border-none" placeholder="Your Name">
                             </div>
                          </div>
                        </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="email" value="{{ auth()->user()->email }}" name="email" class="form-control rounded-0 shadow-none border-none" placeholder="example@example.com" disabled>
                             </div>
                          </div>
                       </div>                         
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="text" value="{{ auth()->user()->phone }}" name="phone" class="form-control rounded-0 shadow-none border-none" placeholder="017xxxxxxxxxx">
                             </div>
                          </div>
                       </div>                          
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <textarea name="address" id="address" rows="5" class="form-control rounded-0 shadow-none border-none">
                                    {{ auth()->user()->address }}
                                </textarea>
                             </div>
                          </div>
                       </div>                                             
                       <div class="errorContainer"></div>
                       <div class="actions"><button class="loginBtn" type="submit">UPDATE</button></div>
                    
                    @endauth
                    </form>
                 </div>
            </div>
        </div>
    </div>
 </div>
 <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Change Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 
            </div>
            <div class="modal-body">
                <div class="phoneNumberLogin authForm">
                    <form method="POST" action="{{ route('front.pasword.change') }}" id="ajaxForm">
                    @csrf                                                                  
                    <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="password" name="old_password" class="form-control rounded-0 shadow-none border-none" placeholder="Enter your current password">
                             </div>
                          </div>
                       </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="password" name="password" class="form-control rounded-0 shadow-none border-none" placeholder="Enter your new password">
                             </div>
                          </div>
                       </div>                       
                       <div class="phoneNumberInputContainer">
                          <div class="phoneNumberLoginField focused">
                             <div class="input">
                                <input type="password" name="password_confirmation" class="form-control rounded-0 shadow-none border-none" placeholder="Re-type your new password">
                             </div>
                          </div>
                       </div>
                       <div class="errorContainer"></div>
                       <div class="actions"><button class="loginBtn" type="submit">UPDATE</button></div>
                    </form>
                 </div>
            </div>
        </div>
    </div>
 </div> 
</body>
</html>