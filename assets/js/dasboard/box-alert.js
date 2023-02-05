(()=> {

    const boxAlertMessage = () => {
        const BOX_ALERT = document.querySelector('.box_alert');
        
        if (BOX_ALERT) {
            
            let time = setTimeout( ()=>{
                BOX_ALERT.remove();
                clearTimeout(time);
            }, 2000);
        }
    }

    boxAlertMessage();

})();