<script src="MediaStreamRecorder.js"> </script>


<button onclick="return record(); ">Start Recording</button>





<script type="text/javascript">


	var mediaConstraints = {
    	audio: true
	};

	
function record(){
navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);

};

function onMediaSuccess(stream) {
    var mediaRecorder = new MediaStreamRecorder(stream);
    mediaRecorder.mimeType = 'audio/wav';
    mediaRecorder.audioChannels = 1;
    mediaRecorder.bufferSize = 1024;
    mediaRecorder.ondataavailable = function (blob) {
        // POST/PUT "Blob" using FormData/XHR2
        console.log(blob);
       /* save file in database */
        var ti = Date.now(); 
        var fileType = 'audio'; // or "audio"
		var fileName = 'record'+ti+'.mp3';  // or "wav" or "ogg"

		var formData = new FormData();
		formData.append(fileType + '-filename', fileName);
		formData.append(fileType + '-blob', blob);

		xhr('upload.php', formData, function (fileURL) {
		    window.open(fileURL);
		});
		
		/* save file in database */


        //var blobURL = URL.createObjectURL(blob);
        //document.write('<a href="' + blobURL + '">' + blobURL + '</a>');
    };
    mediaRecorder.start(5000);
     mediaRecorder.stop(5000);
}

function onMediaError(e) {
   // console.error('media error', e);
}


function xhr(url, data, callback) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            callback(location.href + request.responseText);
        }
    };
    request.open('POST', url);
    request.send(data);
}

</script>
