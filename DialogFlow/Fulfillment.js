'use strict';

const fetch = require('node-fetch');
const functions = require('firebase-functions');
const {WebhookClient} = require('dialogflow-fulfillment');
const {Card, Suggestion} = require('dialogflow-fulfillment');
const {dialogflow, Image} = require('actions-on-google');

process.env.DEBUG = 'dialogflow:debug'; // enables lib debugging statements

// Create an app instance
const app = dialogflow();

exports.fulfillment = functions.https.onRequest(app);
exports.dialogflowFirebaseFulfillment = functions.https.onRequest((request, response) => {

const agent = new WebhookClient({ request, response });
console.log('Dialogflow Request headers: ' + JSON.stringify(request.headers));
console.log('Dialogflow Request body: ' + JSON.stringify(request.body));

// ------------------------------------------------------------------------------------------------------------------------------
  
  function sendAccountInfo(agent) {
    
    var account = agent.parameters.accounttype;
    console.log('Account selected - ', account);
    
    var url = "http://btpproject2019.000webhostapp.com/APIs/selectaccount.php/?accounttype=" + account;
    
    return fetch(url)
    .then(result => result.json())
    .then(response =>  {
      
      agent.add('Your ' + account +  ' account is selected. Would you like to see account details ?');
      
    });    
  }
  
  
// ------------------------------------------------------------------------------------------------------------------------------

  function getAccountDetails() {
    
    return fetch('https://btpproject2019.000webhostapp.com/APIs/getcurrentlyactiveuser.php')
    .then(result => result.json())
    .then(response => {
     
      return fetch('https://btpproject2019.000webhostapp.com/APIs/userinfo.php?accountnumber=' + response.accountnumber)
      .then(result => result.json())
      .then(response => {
        
      console.log('ANUDISH JAIN - 2 -', response);   
      agent.add('This account is registered under the name, ' + response.firstname + ' ' + response.lastname); 
      agent.add('The savings account balance is ' + response.savingsbalance + ' rupees and the current account balance is ' + response.currentbalance + ' rupees. To withdraw cash just say, withdraw followed by the amount');  

      });

    });
    
  } 
     
  // ------------------------------------------------------------------------------------------------------------------------------

  function withdrawAmount(agent) {
    
    var account_number = 1;    
    console.log('Function Running for sending Withdrawal');

    return fetch('https://btpproject2019.000webhostapp.com/APIs/getcurrentlyactiveuser.php')
    .then(result => result.json())
    .then(response => {
     
      console.log(response);
      account_number = response.accountnumber;
      
      var url = "https://btpproject2019.000webhostapp.com/APIs/deductamount.php?accountnumber=";
      url += account_number + "&amount=";
      url += agent.parameters.withdrawAmount;
            
      return fetch(url)
      .then(result => result.json())
      .then(response => {
      
        console.log('ANUDISH JAIN - 3 - ', response);

        if(response.success === 1)
        {
          agent.add('Withdrawal was completed, kindly collect the cash from the dispenser');
          agent.add('To exit the ATM, just say, end the process');
        }

        else
          agent.add('Sorry, some error was encountered.');
      });
    }); 
  }
  
// ------------------------------------------------------------------------------------------------------------------------------
  
  let intentMap = new Map();  

  intentMap.set('Choose-Account', sendAccountInfo);
  intentMap.set('Show-Account-Details', getAccountDetails);
  intentMap.set('Check-Account-Details-Yes', getAccountDetails);
  intentMap.set('Withdraw-Amount', withdrawAmount);
  agent.handleRequest(intentMap);  
  
});
