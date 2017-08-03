<html>
<head>
<script type='text/javascript' src='jwplayer/jwplayer.js'></script>
</head>

<body>
<div id='container'>Loading the player...</div>
<?php
$stringToSign = 'GET https://cdn.bambuser.net/broadcasts/a3e1a07b-6169-4748-16d1-288c2703d196?da_id=a3e1a07b-6169-4748-16d1-288c2703d196&da_timestamp=1471360487&da_nonce=0.7911932193674147&da_signature_method=HMAC-SHA256';  
$signature = hash_hmac('SHA256', $stringToSign, '9b06f7a4adc0a84985c1d47182c5fbc46ef9b34e');
?>


<script type='text/javascript'>
jwplayer('container').setup({
  flashplayer: 'jwplayer/player.swf',
  file:'https://static.bambuser.com/dist/player/iframeapi/?frameId=player-9949813&resourceUri=https%3A%2F%2Fcdn.bambuser.net%2Fbroadcasts%2F7715c906-e81e-45bf-aa06-a65c11787918%3Fda_signature_method%3DHMAC-SHA256%26da_id%3D9e1b1e83-657d-7c83-b8e7-0b782ac9543a%26da_timestamp%3D1500972026%26da_static%3D1%26da_ttl%3D0%26da_signature%3Df6366242fba89fec4a6c3713cb8cf72b10119155b80f6ed15830e2f229ecd263&volume=0&autoplay=false&timeshift=false&usePreviewAsPoster=undefined&applicationId=8oWeUkW3TKSxDJEndIqrA',
  height: 400,
  width: 600,
  'playlist.position': 'right',
  'playlist.size': 80
  })

</script>
</body>
</html>
