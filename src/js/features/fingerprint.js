let currentFormat = Fingerprint.SampleFormat.PngImage;
let sendFiles;

console.log(Fingerprint);

let FingerPrintReader = (function () {
	function FingerPrintReader() {
		let _instance = this;
		this.operationToRestart = null;
		this.acquisitionStarted = false;
		// instantiating the fingerprint sdk here

		this.sdk = new Fingerprint.WebApi();
		this.sdk.onDeviceConnected = function (e) {
			// Detects if the device is connected for which acquisition started
			console.log('Scan Appropriate Finger on the Reader', 'success');
		};
		this.sdk.onDeviceDisconnected = function (e) {
			// Detects if device gets disconnected - provides deviceUid of disconnected device
			console.log('Device is Disconnected. Please Connect Back');
		};
		this.sdk.onCommunicationFailed = function (e) {
			// Detects if there is a failure in communicating with U.R.U web SDK
			console.log('Communication Failed. Please Reconnect Device');
		};
		this.sdk.onSamplesAcquired = function (s) {
			// Sample acquired event triggers this function

			// storeSample(sample)

			document.getElementById('fingerscanner').classList.remove('hidden');

			const res = JSON.parse(s.samples);

			// console.log(res)

			const getBase64 = res[0];

			// console.log(getBase64.length)

			// console.log(getBase64);

			let ctvx = Fingerprint.b64UrlTo64(getBase64);

			let image = document.getElementById('getFingerImage');

			let count = JSON.parse(localStorage.getItem('counter')) ?? 2;


				count--;

				localStorage.setItem('counter', JSON.stringify(count));

				if (localStorage.getItem('counter')) {
					let parse = JSON.parse(localStorage.getItem('counter'));
		

				setTimeout(() => {
					if (parse === 1) {
						$('#getFingerImage').removeClass('hidden');
						document.getElementById('fingerscanner').classList.add('hidden');

						const baseString = 'data:image/png;base64,' + ctvx;

						const imgScanner = `<img  class='drop-shadow-md'src=${baseString} alt='finger scan' width='90' height='90'/>`;

						image.innerHTML += imgScanner;
					
					let lrn = $('#lrn').val()
					let fingerRenameFile = `fingerprint${lrn}.png`;

						var file = dataURLtoFile(baseString, fingerRenameFile);
						console.log(file);
						sendFiles = file;
						

						$('#biometricDone').removeClass('hidden');

						$('#reset').removeClass('hidden');
					} else {
						Swal.fire({
							title: 'Do you want to retake?',
							text: "Device rescan your fingerprint again",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Retake!',
						}).then((result) => {
							if (result.isConfirmed) {
									document.getElementById('fingerscanner').classList.add('hidden');
									resetCapture();
								$('#biometricDone').addClass('hidden');
								

							}
							else{
									document.getElementById('fingerscanner').classList.add('hidden');
								$('#biometricDone').addClass('hidden');

							}
						});
					
					}
				}, 3000);
				}

			// console.log(intermidiate, 'get base');
			// console.log(ctvx, 'get ctvx');

		};
		this.sdk.onQualityReported = function (e) {
			// Quality of sample acquired - Function triggered on every sample acquired
			//document.getElementById("qualityInputBox").value = Fingerprint.QualityCode[(e.quality)];
		};
	}

	// this is were finger print capture takes place
	FingerPrintReader.prototype.startCapture = function () {
		if (this.acquisitionStarted)
			// Monitoring if already started capturing
			return;
		let _instance = this;
		console.log('');
		this.operationToRestart = this.startCapture;
		this.sdk.startAcquisition(currentFormat, '').then(
			function () {
				_instance.acquisitionStarted = true;

				//Disabling start once started
				//disableEnableStartStop();
			},
			function (error) {
				console.log(error.message);
			},
		);
	};

	FingerPrintReader.prototype.stopCapture = function () {
		if (!this.acquisitionStarted)
			//Monitor if already stopped capturing
			return;
		let _instance = this;
		console.log('');
		this.sdk.stopAcquisition().then(
			function () {
				_instance.acquisitionStarted = false;

				//Disabling stop once stopped
				//disableEnableStartStop();
			},
			function (error) {
				console.log(error.message);
			},
		);
	};

	FingerPrintReader.prototype.getInfo = function () {
		let _instance = this;
		return this.sdk.enumerateDevices();
	};

	FingerPrintReader.prototype.getDeviceInfoWithID = function (uid) {
		let _instance = this;
		return this.sdk.getDeviceInfo(uid);
	};

	return FingerPrintReader;
})();


function retrieveFiles(){
	return sendFiles;
}

// convert base64 to actual images

function dataURLtoFile(dataurl, filename) {
	var arr = dataurl.split(','),
		mime = arr[0].match(/:(.*?);/)[1],
		bstr = atob(arr[1]),
		n = bstr.length,
		u8arr = new Uint8Array(n);
	while (n--) {
		u8arr[n] = bstr.charCodeAt(n);
	}
	return new File([u8arr], filename, { type: mime });
}

// convert base64 to actual images

function urltoFile(url, filename, mimeType) {
	mimeType = mimeType || (url.match(/^data:([^;]+);/) || '')[1];
	return fetch(url)
		.then(function (res) {
			return res.arrayBuffer();
		})
		.then(function (buf) {
			return new File([buf], filename, { type: mimeType });
		});
}

let getSampleFormat = [];
let searchParams = new URLSearchParams(window.parent.location.search);

if (searchParams.get('page') === 'login') {
	const scan = document.getElementById('getScan');
	const btnEnroll = document.getElementById('btnEnroll');

	btnEnroll.textContent = 'Verify your identity';
	scan.textContent = 'Identifying your account';
}

function storeSample(sample) {
	const scanningLoader = document.getElementById('fingerscanner');
	const beginEnroll = document.getElementById('beginEnroll');

	const enrollNow = document.getElementById('enrollNow');
	const attempt = document.getElementById('counter');

	scanningLoader.classList.add('scan');

	setTimeout(() => {
		scanningLoader.classList.remove('scan');

		let counter = JSON.parse(localStorage.getItem('left')) ?? 4;

		console.log(counter, 'get counter');

		counter--; // Increment the counter

		if (searchParams.get('page') === 'create') {
			attempt.textContent = counter;
		}

		localStorage.setItem('left', JSON.stringify(counter));

		let samples = JSON.parse(sample.samples);
		let sampleData = samples[0].Data;

		getSampleFormat.push(sampleData);

		if ((searchParams.get('page') === 'create' && counter === 0) || (searchParams.get('page') === 'login' && counter === 3)) {
			sendChangeIframeClassMessage(['w-full', 'h-full', 'mx-auto']);

			beginEnroll.classList.add('hidden');

			enrollNow.classList.remove('hidden');
			localStorage.removeItem('left');
		}
	}, 3000);
}

function sendChangeIframeClassMessage(newClasses) {
	window.parent.postMessage(
		{
			action: 'changeIframeClass',
			newClasses: newClasses,
		},
		'*',
	);
}

function showMsgAlert(message, type) {
	window.parent.postMessage({ action: 'showAlertMsg', message, type }, '*');
}




function resetCapture(){

 localStorage.removeItem('counter');

	const reader = new FingerPrintReader();


	 reader.stopCapture();

		$('#getFingerImage').html('');
		$('#getFingerImage').addClass('hidden');
		$('#reset').addClass('hidden');
}

function validateConnection() {
	const reader = new FingerPrintReader();

	const getDeviceConnected = reader.getInfo();

	const loader = document.getElementById('loader');
	const checkDevice = document.getElementById('checkDevice');
	const beginEnroll = document.getElementById('beginEnroll');

	loader.classList.remove('hidden');

	setTimeout(() => {
		getDeviceConnected.then((res) => {
			console.log(res, 'get res');
			if (res.length > 0) {
				loader.textContent = 'Device Connected';
				checkDevice.classList.add('hidden');
				beginEnroll.classList.remove('hidden');
				reader.startCapture();

				// sendChangeIframeClassMessage(['w-[300px]', 'h-[600px]', 'mx-auto']);

				//    setTimeout(() => {
				//     const frameSrc = document.getElementById('frameSrc');

				//     frameSrc.classList.remove('w-full' ,'h-full');
				//     frameSrc.classList.add('w-[300px]' ,'h-[600px]');
				//     }, 5000);
			} else {
				loader.innerHTML = '<span class="text-red-500 font-bold text-center text-sm">Device is Disconnected , Please check your device</span>';
			}
		});
	}, 3000);
}
