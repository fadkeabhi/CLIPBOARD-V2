function copyToClipboard() {
    var copyText = document.getElementById("get_clip").value;
    navigator.clipboard.writeText(copyText).then(() => {
        $("#get_msg").text("Copied to clipboard.");
    });
  }
