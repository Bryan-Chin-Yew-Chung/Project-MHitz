/*    
<script src = "../js/confirm.js"> </script> 
<script>
  document.querySelector('#btnChangeBg').addEventListener('click', () => {
    Confirm.open({
      title: 'Background Change',
      message: 'Are you sure you wish the background color?',
      onok: () => {
        document.body.style.backgroundColor = 'blue';
      }
    })
  });
</script>

*/



const Confirm = {
    open (options){
        options = Object.assign({} , {
            title: '',
            message: '',
            okText: 'OK',
            cancelText: 'Cancel',
            onok: function () {},
            oncancel: function () {}
        } , options);


        const html = `
            <div class=confirm>  
                <div class="confirmwindow">
                    <div class="confirmtitle">
                        <span class="title"> ${options.title} </span>
                        <button class="close"> &times; </button>
                    </div>
                    <div class = "content"> ${options.message} </div>
                    <div class="button">
                        <button class="confirmButton confirmButton--OK confirmButton--Fill"> ${options.okText} </button>
                        <button class="confirmButton confirmButton--CANCEL"> ${options.cancelText} </button>
                    </div>
                </div>
            </div>        
       
        `;
        
        const template = document.createElement('template');
        template.innerHTML = html;

        const confirm = template.content.querySelector('.confirm');
        const btnClose = template.content.querySelector('.close');
        const btnOK = template.content.querySelector('.confirmButton--OK');
        const btnCancel = template.content.querySelector('.confirmButton--CANCEL');

        document.body.appendChild(template.content);

        confirm.addEventListener('click' , e=> {
            if (e.target === confirm){
                options.oncancel();
                this._close(confirm);
            }
        });

        btnOK.addEventListener('click' , ()=> {
                options.onok();
                this._close(confirm);
        });

        [btnCancel,btnClose].forEach (el =>  {
            el.addEventListener('click' , () => {
                options.oncancel();
                this._close(confirm);
            })
        });
    },



    _close(confirm){
        confirm.classList.add('confirm---close');
        confirm.addEventListener('animationend' , ()=> {
            document.body.removeChild(confirm);
        })
    }
};