<!DOCTYPE html>
<html>
<head>
	<title>Preview Window</title>
</head>
<body>
	<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="preview-btn" data-src="https://www.youtube.com/embed/dQw4w9WgXcQ">Open Preview Window</a>
	<a href="https://www.google.com">google</a>
	<script>
	    const previewBtns = document.querySelectorAll('.preview-btn');
	    const previewModal = document.createElement('div');
	    const previewFrame = document.createElement('iframe');
	    const closeBtn = document.createElement('button');

	    // Styling for the preview modal
	    previewFrame.style.margin = 'auto';
	    previewModal.style.position = 'fixed';
	    previewModal.style.top = '0';
	    previewModal.style.left = '0';
	    previewModal.style.width = '100%';
	    previewModal.style.height = '100%';
	    previewModal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
	    previewModal.style.display = 'none';
	    previewModal.style.zIndex = '9999';
	    previewModal.style.display = 'flex'; // center horizontally
	    previewModal.style.justifyContent = 'center'; // center horizontally
	    previewFrame.style.width = '90vw';
	    previewFrame.style.height = '80vh';
	    previewFrame.style.display = 'block';
	    previewFrame.style.border = 'none';
	    previewFrame.style.margin = 'auto';
	    previewFrame.style.marginTop = '5vh';
	    previewFrame.style.position = 'relative';
	    previewFrame.style.align= "center";
	    closeBtn.style.position = 'absolute';
	    closeBtn.style.top = '2vh';
	    closeBtn.style.right = '2vh';
	    closeBtn.style.padding = '0.5rem';
	    closeBtn.style.fontSize = '1.2rem';
	    closeBtn.style.borderRadius = '50%';
	    closeBtn.style.backgroundColor = '#fff';
	       // Add event listener to each preview button
		   previewBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const src = this.getAttribute('data-src');
            previewFrame.setAttribute('src', src);
            previewModal.appendChild(previewFrame);
            previewModal.appendChild(closeBtn);
            document.body.appendChild(previewModal);
            previewModal.style.display = 'flex';
        });
    });

    // Add event listener to close button
    closeBtn.addEventListener('click', function() {
        previewModal.style.display = 'none';
        previewFrame.setAttribute('src', '');
        previewModal.removeChild(previewFrame);
        previewModal.removeChild(closeBtn);
    });
</script>

