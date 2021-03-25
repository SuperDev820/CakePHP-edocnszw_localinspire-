<!-- ========== MAIN ========== -->
<main class="bg-light" id="content" role="main">
  <!-- Hero Section -->
  <div class="container space-2">
    <div class="col-md-12">
      <center>
        <h2 class="text-graylt h3 font-weight-semi-bold">Thank you <?= $currentUser->firstname ?> for successfully claiming your <br><b>free</b> business account for <b><?= $business->name ?></b>!</h2>
      </center>

      <div class="card p-3 mt-5 ml-5 mb-8 mr-5">
        <p> You currently have the <span class="bold">Free</span> plan... Upgrade to localinspire’s <b>Enhanced Business Profile</b> plan which provides all of localinspire’s free tools plus our upgraded business features and tools to help you manage your business page, connect with your customers, and so much more. Start today and grow your business to a whole new level.</p>
      </div>

      <?php echo $this->element('upgrade_block', ['business' => $business, 'claim' => true])
      ?>

      
    </div>
  </div>

</main>
<!-- End Content -->