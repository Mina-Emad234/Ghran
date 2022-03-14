var SITE = SITE || {};

// Display selected file name inside the button
//SITE.fileInputs = function() {
//  var $this = $(this),
//      $val = $this.val(),
//      valArray = $val.split('\\'),
//      newVal = valArray[valArray.length-2],
//      $button = $this.siblings('.button');
//  if(newVal !== '') {
//    $button.text(newVal);
//  }
//};

// Display selected file name next to button

SITE.fileInputs = function() {
  var $this = $(this),
      $val = $this.val(),
      valArray = $val.split('\\'),
      newVal = valArray[valArray.length-1],
      $button = $this.siblings('.button'),
      $fakeFile = $this.siblings('.fileHolder');
  if(newVal !== '') {
    $button.text('تغيير الملف');
    if($fakeFile.length === 0) {
      $button.before('<span class="fileHolder rnd5">' + newVal + '</span>');
    } else {
      $fakeFile.text(newVal);
    }
  }
};
