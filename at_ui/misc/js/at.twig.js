(function($){

setTimeout(function(){
  var save = function() {
    $('#edit-string').parents('form').trigger('submit');
  };

  CodeMirror.defineMode("mustache", function(config, parserConfig) {
    var mustacheOverlay = {
      token: function(stream, state) {
        var ch;
        if (stream.match("{{")) {
          while ((ch = stream.next()) != null)
            if (ch == "}" && stream.next() == "}") break;
          stream.eat("}");
          return "mustache";
        }
        while (stream.next() != null && !stream.match("{{", false)) {}
        return null;
      }
    };

    return CodeMirror
            .overlayMode(CodeMirror.getMode(config, parserConfig.backdrop || "text/html"), mustacheOverlay);
  });

  var editor = CodeMirror.fromTextArea(document.getElementById("edit-string"), {
    lineNumbers: true
    , viewportMargin: Infinity
    , theme: 'monokai'
    , extraKeys: {"Cmd-S": save , "Ctrl-S": save}
    , mode: "mustache"
  });

}, 500);

})(jQuery);