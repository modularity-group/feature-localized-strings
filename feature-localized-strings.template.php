<style>
  .localized-strings.wrap {
    max-width: 1000px;
  }

  .localized-strings h1,
  .localized-strings form {
    margin-bottom: var(--base-space);
  }

  .localized-strings hr {
    border-top: 1px solid #ccc;
  }

  .localized-strings label {
    vertical-align: baseline;
    margin-right: 10px;
    font-weight: bold;
    display: block;
    margin-bottom: 7px;
  }

  .localized-strings input[data-field=string]{
    width: calc(100% - 100px);
    margin-bottom: 7px;
  }

  .localized-strings input[data-field=locale]{
    width: 70px;
    margin-bottom: 7px;
  }

  .localized-strings input[data-field=translation]{
    width: calc(100% - 130px);
    margin-bottom: 7px;
  }

  .localized-strings__list {

  }

  .localized-strings__item {
    margin: var(--base-space) 0;
    display: grid;
    grid-template-columns: 50% 50%;
    padding-bottom: var(--base-space);
    border-bottom: 1px solid #ccc;
  }

  .localized-strings__item__string {

  }

  .localized-strings footer {
    margin-top: var(--base-space);
  }

  .localized-strings .hide {
    display: none !important;
  }

  .localized-strings ul {
    list-style-type: disc;
    list-style-position: inside;
  }
</style>

<script>
jQuery(function($) {
  $(document).ready(function(){
    addTranslationClickEvents();
  });

  $('.button.validate').click(function(event){
    event.preventDefault();

    $('.localized-strings__item').each(function($i){
      var $s = $(this).find('input[data-field=string]').val();
      var $baseKey = 'localized-strings['+$s+']';
      $(this).find('input[data-field=translation]').each(function(){
        $(this).attr('name',$baseKey+'['+$(this).parent().find('input[data-field=locale]').val()+']');
      });
    });

    $('footer input[type=submit]').removeClass('hide');
  });

  $('.button.addString').click(function(event){
    event.preventDefault();
    const $stringItem = document.createElement('div');
    $stringItem.className = 'localized-strings__item';
    $stringItem.innerHTML = `
      <div class="localized-strings__item__string">
        <label>String</label>
        <input type="text" data-field="string" placeholder="string name from your template" value="">
        <button class="button button-primary button-small" onClick="this.parentElement.parentElement.remove()">- Remove String</button>
      </div>
      <div class="localized-strings__item__translations">
      <label>Locale, Translation</label>
        <div class="localized-strings__item__translations__list">
          <div class="localized-strings__item__translations__item">
            <input type="text" data-field="locale" value="" maxlength="5" placeholder="de_DE">
            <input type="text" data-field="translation" value="">
            <button class="button button-primary button-small removeTranslation" onClick="this.parentElement.remove()">-</button>
          </div>
        </div>
        <span class="button button-primary button-small addTranslation">+</span>
      </div>
    `;

    document.querySelector('.localized-strings__list').appendChild($stringItem);
    addTranslationClickEvents();
  });

  function addTranslationClickEvents(){
    $('.button.addTranslation').click(function(event){
      event.preventDefault();
      const $translationItem = document.createElement('div');
      $translationItem.className = 'localized-strings__item__translations__item';
      $translationItem.innerHTML = `
        <input type="text" data-field="locale" value="" maxlength="5" placeholder="de_DE">
        <input type="text" data-field="translation" value="">
        <button class="button button-primary button-small" onClick="this.parentElement.remove()">-</button>
      `;
      this.parentElement.insertBefore($translationItem,this);
    });
  }

  $('.localized-strings__item input[type=text]').keyup(function(){
    $('footer input[type=submit]').addClass('hide');
  });

});

</script>

<div class="wrap localized-strings">
  <h1>Localized Strings</h1>
  <?php echo "Your actual locale is: <strong>".get_locale().'</strong><br>'; ?>
  <?php
  $localized_strings = json_decode(get_option('localized-strings'),true);
  ?>
  <form method="POST">

    <div class="localized-strings__list">

    <hr>

    <?php foreach($localized_strings as $string => $translations){ ?>

    <div class="localized-strings__item">
      <div class="localized-strings__item__string">
        <label>String</label>
        <input type="text" data-field="string" value="<?= $string ?>">
        <button class="button button-primary button-small" onClick="this.parentElement.parentElement.remove()">- Remove String</button>
      </div>

      <div class="localized-strings__item__translations">
      <label>Locale, Translation</label>
        <div class="localized-strings__item__translations__list">

          <?php foreach($translations as $locale => $translation){ ?>

          <div class="localized-strings__item__translations__item">
            <input type="text" data-field="locale" value="<?= $locale ?>" maxlength="5" placeholder="de_DE">
            <input type="text" data-field="translation" value="<?= $translation ?>">
            <button class="button button-primary button-small removeTranslation" onClick="this.parentElement.remove()">-</button>
          </div>

          <?php } ?>

        </div>
        <span class="button button-primary button-small addTranslation">+</span>
      </div>

    </div>

    <?php } ?>

    </div>

    <button class="button button-primary button-small addString">+ Add String</button>

    <footer>
      <button class="button button-primary button-large validate">Validate</button>
      <input type="submit" value="Save" class="button button-primary button-large hide">
    </footer>
  </form>
  <hr>
  <h2>Instructions</h2>
  <ul>
    <li>use php-function <code>__ls('some string in your template')</code> in your theme</li>
    <li>add <code>some string in your template</code> here to provide translations for that string</li>
    <li>use respective locale (f.e. <code>de_DE</code> for german) to define the translations language</li>
    <li>php output of <code>__ls()</code> function uses actual locale for string output (should be compatible with every multilang-plugin that sets the current locale after lang-switch).</li>
    <li>if needed you can also overide the locale when calling the function <code>__ls('some string in your template','en_GB')</code></li>
  </ul>
</div>
