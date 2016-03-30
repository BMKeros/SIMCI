(function(ALERTIfy){

  //Dialogo de datasheet
  ALERTIfy.DataSheetDialog || ALERTIfy.dialog('DataSheetDialog',function(){
    var iframe;

    return {
      // constructor del dialogo este se ejecuta cuando se llama al dialog alertify.DataSheetDialog(RactivoID)
      main:function(reactivoID){
        // se guarda el id del reactivo que se le generara el pdf
        return this.set({ 
          'reactivoID': reactivoID
        });
      },
        
      setup: function(){
        return {
          options: {
            padding : !1,
            overflow: !1,
          },
        };
      },
      // This will be called once the DOM is ready and will never be invoked again.
      // aqui es donde se creara el iframe que contendra el pdf
      build:function(){           
        iframe = document.createElement('iframe');
        iframe.frameBorder = "no";
        iframe.width = "100%";
        iframe.height = "100%";
        iframe.setAttribute('allowfullscreen',true);
        iframe.setAttribute('webkitallowfullscreen',true);
        
        this.elements.content.appendChild(iframe);

        this.elements.body.style.minHeight = screen.height * .5 + 'px';

        this.setHeader('DataSheet');
      },
      prepare: function () {
          this.set('resizable',true).resizeTo('70%','80%');
      },
      settings:{
          reactivoID: undefined
      },
      settingUpdated:function(key, oldValue, newValue){
        switch(key){
          case 'reactivoID':
              this.setHeader('<i class="lab icon"></i>DataSheet '+newValue);
            iframe.src = '/bower_components/viewerjs/ViewerJS/index.html?zoom=page-width#../../../datasheet/generar-pdf/' + newValue;
          break;   
        }
      },
        
      hooks:{
        onshow: function(){},
        onclose: function(){},
        onupdate: function(option,oldValue, newValue){
          switch(option){
            case 'resizable':
              if(newValue){
                  this.elements.content.removeAttribute('style');
                  iframe && iframe.removeAttribute('style');
              }else{
                  this.elements.content.style.minHeight = 'inherit';
                  iframe && (iframe.style.minHeight = 'inherit');
              }
            break;    
          }    
        }
      }
    };
  });
  //Fin del dialogo de datasheet

})(alertify);





  


