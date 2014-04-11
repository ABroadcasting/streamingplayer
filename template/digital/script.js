    $(document).ready(function() {
        $('#audio-player').mediaelementplayer({
            alwaysShowControls: true,
            features: ['playpause','volume'],
            audioVolume: 'horizontal',
            audioWidth: 400,
            audioHeight: 120
        });
    });
	