          <div class="row">
            <div class="col-8">
              <h2>Add New Field</h2>
              <form>
              <div class="form-group">
                <label for="field_name">Field Name</label>
                <input type="text" class="form-control" id="field_name" placeholder="any name">
              </div>
              <div class="form-group">
                <label for="field_placeholder">Placeholder</label>
                <input type="text" class="form-control" id="field_placeholder" placeholder="helper text">
              </div>
              <!-- Select Form -->
              <div class="form-group">
                <label for="field_type">Field Type</label>
                <select class="form-control" id="field_type">
                  <option>Short Text</option>
                  <option>Paragraph</option>
                  <option></option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <!-- Text Field -->
              <div class="form-group">
                <label for="field_value">Placeholder</label>
                <input type="text" class="form-control" id="field_value" placeholder="use comma to separate values">
              </div>
              <!-- Text Area -->
              <div class="form-group">
                <label for="field_value">Text Area</label>
                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
              </div>
              <!-- Radion Buttons -->
              <fieldset class="form-group">
                <legend>Radio buttons</legend>
                <label for="field_value">Radio Button Sub Heading</label>

                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                    Option one is this and that&mdash;be sure to include why it's great
                  </label>
                </div>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                    Option two can be something else and selecting it will deselect option one
                  </label>
                </div>
                <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                    Option three is disabled
                  </label>
                </div>
              </fieldset>



              <button type="submit" class="btn btn-primary mb-2" name="create_form">Confirm identity</button>
              </form>
            </div>
            
            <div class="col-4">
            <h4>Tip</h4>
            <p>Fields should be created first before you can add them to a form.</p>
            </div>
          </div>