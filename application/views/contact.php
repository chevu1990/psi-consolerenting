<div class="container">
	<div class="row">
      <div class="col-md-10 col-md-offset-1" >
        <div class="well well-sm">
          <form class="form-horizontal" action="mail" method="post">
          <fieldset>
            <legend class="text-center">Contact us</legend>
    
            <!-- Name input-->
            <div class="form-group">
                <label class="col-md-3 control-label" for="name" style="font-size: 130%;">Name</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Your name" class="form-control" style="font-size: 130%">
                <br />
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email" style="font-size: 130%;">Your E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                <br />
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message" style="font-size: 130%;">Your message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5" style="font-size: 130%;"></textarea>
                <br />
              </div>
            </div>
    
            <label class="control-label" for="info">To contact us, you must be logged in!</label>

            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
	</div>
</div>