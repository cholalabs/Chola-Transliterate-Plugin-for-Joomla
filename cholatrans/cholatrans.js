 google.load("elements", "1", {
            packages: "transliteration"
          });
   

      function onLoad() {
        
       

        
        var options = {
           sourceLanguage:
                sourcelang,
            destinationLanguage:
                [destlang],
            shortcutKey: 'ctrl+g',
            transliterationEnabled: true
        };
     
   
 
        var control =
            new google.elements.transliteration.TransliterationControl(options);
        jQuery.noConflict();

    
       
       var allTextBoxes = jQuery("input[type='text'],textarea,iframe").not(".frontlogin,.ajaxsearch .inputbox").toArray();
     
        control.makeTransliteratable(allTextBoxes);


      }
      google.setOnLoadCallback(onLoad);