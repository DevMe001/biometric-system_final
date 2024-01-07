


let formatSelected = Fingerprint.SampleFormat.Intermediate;

console.log(Fingerprint);

let BiometricReaderIntermidiate = (function () {
	function BiometricReaderIntermidiate() {
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
		this.sdk.onSamplesAcquired = function (sample) {
			// Sample acquired event triggers this function


			const getParams = new URLSearchParams(window.location.search);


			console.log(getParams);

			if (getParams.get('page') == 'attendance') {
				verifyIdentity(sample);
			} else {
				storeFingerprintSample(sample);
			}

		};
		this.sdk.onQualityReported = function (e) {
			// Quality of sample acquired - Function triggered on every sample acquired
			//document.getElementById("qualityInputBox").value = Fingerprint.QualityCode[(e.quality)];
		};
	}

	// this is were finger print capture takes place
	BiometricReaderIntermidiate.prototype.startCapture = function () {
		if (this.acquisitionStarted)
			// Monitoring if already started capturing
			return;
		let _instance = this;
		console.log('');
		this.operationToRestart = this.startCapture;
		this.sdk.startAcquisition(formatSelected, '').then(
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

	BiometricReaderIntermidiate.prototype.stopCapture = function () {
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

	BiometricReaderIntermidiate.prototype.getInfo = function () {
		let _instance = this;
		return this.sdk.enumerateDevices();
	};

	BiometricReaderIntermidiate.prototype.getDeviceInfoWithID = function (uid) {
		let _instance = this;
		return this.sdk.getDeviceInfo(uid);
	};

	return BiometricReaderIntermidiate;
})();

let listSampleFormat = [];

// getsrcsample
function storeFingerprintSample(sample) {

	console.log(sample,'get sample record');

	$('#biometric__scanItem').removeClass('hidden');

	$('#ctaMsg').removeClass(['hidden', 'text-green-600']);
	$('#ctaMsg').addClass('text-gray-200');

	$('#ctaMsg').text('Scanning...');
	setTimeout(() => {
		$('#biometric__scanItem').addClass('hidden');
		let count = JSON.parse(localStorage.getItem('counterLeft')) ?? 4;
		console.log(count, 'get counter');

		let samples = JSON.parse(sample.samples);
		let sampleData = samples[0].Data;


		if(count == 4){
		 listSampleFormat.push(sampleData);
		}

		count--; // Increment the counter


	 		
		console.log(count, 'get counter -');
		console.log(sampleData, 'sample item');
    
			$('#ctaMsg').addClass('hidden');


					if (count > 0 && count<= 3) {
						


						console.log('get me hey')
						 localStorage.setItem('counterLeft', JSON.stringify(count));
						listSampleFormat.push(sampleData);

						$('#counterItem').text(count);

						if(count == 1 ){
							
								$('#getTimeLabel').text('time');

						}
					
					} else {
						if(count <= 0){
								localStorage.removeItem('counterLeft');
								$('#counterItem').text(count);
								$('#getTimeLabel').text('time');
									$('#ctaMsg').removeClass(['hidden', 'text-gray-200']);

									$('#ctaMsg').addClass(['text-green-600']);

									$('#ctaMsg').text('Completed');

									$('#attendanceNextBtn__3').removeClass('hidden');
									$('#fingerprintNextBtn__3').removeClass('hidden');

								console.log(listSampleFormat, 'all list format stored');
						}
					}



	}, 3000);

}


function verifyIdentity(sample){



		let samples = JSON.parse(sample.samples);
		let sampleData = samples[0].Data;


	  listSampleFormat.push(sampleData);
	

		
	$('#scanningDevice').removeClass('hidden');

	setTimeout(() => {
		$('#scanningDevice').addClass('hidden');

		$('#ontoggleAttendance').click();


	}, 3000);

}




// end get source sample

// check the device if its connected

 function deviceCheck(cb) {

	const reader = new BiometricReaderIntermidiate();

	const getDeviceConnected = reader.getInfo();

	const loader = document.getElementById('spinLoaderDevice');


	loader.classList.remove('hidden');

	setTimeout(() => {
		getDeviceConnected.then((res) => {
			console.log(res, 'get respondnt');
			if (res.length > 0) {
			$('#deviceMsg').removeClass('hidden');

				
			$('#deviceMsg').text('Device Connected');
			
				reader.startCapture();

				loader.classList.add('hidden');

				cb(true)


			} else {
			$('#deviceMsg').removeClass('hidden');


				loader.classList.add('hidden');
				$('#deviceMsg').text('Device is Disconnected , Please check your device');

					cb(false);
			}
		});
	}, 3000);
}


// end device check


