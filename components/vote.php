<div class="container">
  <form>
      <div class="form-group row validation-messages"></div>
      <div class="form-group row">
          <label class="col-sm-12 col-form-label">Select your favourite track</label>
          <div class="col-sm-12" id="tracks"></div>
          <span class="col-sm-12 help-block"></span>
      </div>
      <div class="form-group row">
          <input type="submit" class="btn btn-primary" value="Make selection" data-track-select>
          <span class="help-block"></span>
      </div>
  </form>
</div>



<script type="text/javascript">
    var xhttp = new XMLHttpRequest(),
      uri = './lib/spotify.php'
      first = true;

    function createOption(id) {
      var container = document.createElement("div");
      container.setAttribute('class', 'form-check');
      var radio = document.createElement("input");
      radio.setAttribute('class', 'form-check-input');
      radio.setAttribute('type', 'radio');
      radio.setAttribute('name', 'trackSelect');
      radio.setAttribute('id', id);
      radio.setAttribute('value', id);
      if (first) {
        first = false;
        radio.setAttribute('checked', true);
      }

      var label = document.createElement("label");;
      container.setAttribute('class', 'form-check-label');
      container.setAttribute('for', id);

      var frame = document.createElement("iframe");
      var attrs = {
        src: 'https://open.spotify.com/embed/track/' + id,
        width: 300,
        height: 80,
        frameborder: 0,
        allowtransparency: true,
        allow: 'encrypted-media'
      };
      for (var i = 0; i < Object.keys(attrs).length; i++) {
        var key = Object.keys(attrs)[i];
        frame.setAttribute(key, attrs[key]);
      }
      container.appendChild(radio);
      container.appendChild(label);
      label.appendChild(frame);
      return container;
    }

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var tracks = JSON.parse(this.response).tracks;

        tracks.forEach(function(item, index){
          document.getElementById('tracks').appendChild(createOption(item));
        })

      }
    };
    xhttp.open("GET", uri, true);
    xhttp.send();

</script>