// Based on https://www.maxlaumeister.com/blog/hide-related-videos-in-youtube-embeds/

document.addEventListener( 'DOMContentLoaded', function() { 
    
    if ( window.hideYTActivated ) return; 
    
    let onYouTubeIframeAPIReadyCallbacks=[]; 
    
    for ( let playerWrap of document.querySelectorAll( ".video-with-form-overlay" ) ) { 
        
        let playerFrame = playerWrap.querySelector( "iframe" );
        
        let tag = document.createElement( 'script' );
        tag.src = "https://www.youtube.com/iframe_api";

        let firstScriptTag = document.getElementsByTagName( 'script' )[0];
        firstScriptTag.parentNode.insertBefore( tag, firstScriptTag );
        
        let onPlayerStateChange = function( event ) { 
            
            if ( event.data == YT.PlayerState.ENDED ) {
                
                playerWrap.classList.add( "ended" );
            
            }
            else if ( event.data == YT.PlayerState.PAUSED ) {
                
                playerWrap.classList.add( "paused" );
            
            }
            else if ( event.data == YT.PlayerState.PLAYING ) {
                
                playerWrap.classList.remove( "ended" ); 
                playerWrap.classList.remove( "paused" ); 

            }
        
        }; 
        
        let player; 
        
        onYouTubeIframeAPIReadyCallbacks.push( function() { 
            
            player = new YT.Player( playerFrame, {
                events: {
                    'onStateChange': onPlayerStateChange
                }
            } );
        
        } );
        
        playerWrap.addEventListener( "click", function( event ) {

            let overlay = playerWrap.querySelectorAll( '.overlay' )[0];

            if ( overlay !== event.target ) return;
            
            let playerState = player.getPlayerState();
            
            if ( playerState == YT.PlayerState.ENDED ) { 
                
                player.seekTo( 0 );
            
            }
            else if ( playerState == YT.PlayerState.PAUSED ) {
                
                player.playVideo();
            
            }
        
        } );
    
    }
    
    window.onYouTubeIframeAPIReady = function() {
        
        for ( let callback of onYouTubeIframeAPIReadyCallbacks ) {
            callback();
        }

    };
    
    window.hideYTActivated = true;

} );