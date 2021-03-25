
    <!-- Content Section -->
    <div class="bg-light">
      <div class="container space-2"> 
        <?php 
        $data['profile'] = $profile;
        $data['profile'] = $this->session_account_data[0];
        $this->load->view('includes/bizsidebar', $data); 
        ?>
     
      <div class="card p-5">
        <form>
          <!-- My Network -->
          <div class="mb-3">
           


          <!-- Account Activity -->
          <div class="mb-4">
            <!-- Title -->
            <div class="row justify-content-between align-items-end">
              <div class="col-6">
                <h2 class="h5 mb-0">Notification Settings</h2>
                Manage what emails are sent to primaryemail@email.com
              </div>
              <div class="col-6 text-right">
                <a id="toggleAll2" class="js-toggle-state link-muted" href="javascript:;"
                   data-target="#checkboxSwitch5, #checkboxSwitch6, #checkboxSwitch7, #checkboxSwitch8, #checkboxSwitch9">
                  <span class="link-muted__toggle-default">Toggle all</span>
                  <span class="link-muted__toggle-toggled">Untoggle all</span>
                </a>
              </div>
            </div>
            <!-- End Title -->

            <hr class="mb-3">

            <div class="mb-3">
              <h3 class="small text-muted">Email me when:</h3>
            </div>

            <!-- Checkbox Switch -->
            <div class="media align-items-center mb-3">
              <label class="checkbox-switch mb-0 mr-3">
                <input type="checkbox" class="checkbox-switch__input" id="checkboxSwitch5" checked>
                <span class="checkbox-switch__slider"></span>
              </label>
              <label class="media-body text-muted mb-0" for="checkboxSwitch5">
                <span class="d-block text-dark">Private messages from a visitor</span>
              </label>
            </div>
            <!-- End Checkbox Switch -->

           

            <!-- Checkbox Switch -->
            <div class="media align-items-center mb-3">
              <label class="checkbox-switch mb-0 mr-3">
                <input type="checkbox" class="checkbox-switch__input" id="checkboxSwitch7">
                <span class="checkbox-switch__slider"></span>
              </label>
              <label class="media-body text-muted mb-0" for="checkboxSwitch7">
                <span class="d-block text-dark">My business receives a question</span>
              </label>
            </div>
            <!-- End Checkbox Switch -->
            
              <!-- Checkbox Switch -->
            <div class="media align-items-center mb-3">
              <label class="checkbox-switch mb-0 mr-3">
                <input type="checkbox" class="checkbox-switch__input" id="checkboxSwitch8" checked>
                <span class="checkbox-switch__slider"></span>
              </label>
              <label class="media-body text-muted mb-0" for="checkboxSwitch8">
                <span class="d-block text-dark">My business's questions receive an answer</span>
              </label>
            </div>
            <!-- End Checkbox Switch -->
            
             <!-- Checkbox Switch -->
            <div class="media align-items-center mb-3">
              <label class="checkbox-switch mb-0 mr-3">
                <input type="checkbox" class="checkbox-switch__input" id="checkboxSwitch8" checked>
                <span class="checkbox-switch__slider"></span>
              </label>
              <label class="media-body text-muted mb-0" for="checkboxSwitch8">
                <span class="d-block text-dark">My business receives a review</span>
              </label>
            </div>
            <!-- End Checkbox Switch -->

           

            <!-- Checkbox Switch -->
            <div class="media align-items-center mb-3">
              <label class="checkbox-switch mb-0 mr-3">
                <input type="checkbox" class="checkbox-switch__input" id="checkboxSwitch9">
                <span class="checkbox-switch__slider"></span>
              </label>
              <label class="media-body text-muted mb-0" for="checkboxSwitch9">
                <span class="d-block text-dark">Private messages from a visitor</span>
              </label>
            </div>
            <!-- End Checkbox Switch -->
            
           
            
            
            
          </div>
          <!-- End Account Activity -->


          <button type="submit" class="btn btn-primary ">Update Email Notifications</button>
        </form>
      </div>
    </div>
    <!-- End Content Section -->
  </main>
  <!-- ========== END MAIN ========== -->
</body>
</html>