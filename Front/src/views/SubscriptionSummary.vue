<template>
    <ion-page>
      <ion-header>
        <ion-toolbar>
          <ion-buttons slot="start">
            <ion-back-button defaultHref="/"></ion-back-button>
          </ion-buttons>
          <ion-title>AirBn'World</ion-title>
        </ion-toolbar>
      </ion-header>
  
      <ion-content class="ion-padding">
        <div class="summary-container">
          <ion-card class="summary-card">
            <ion-card-header>
              <ion-card-title class="ion-text-center">Récapitulatif de commande</ion-card-title>
            </ion-card-header>
  
            <ion-card-content>
              <ion-item>
                <ion-label>Offre</ion-label>
                <ion-note slot="end">Solo (1 pers.)</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label>Prix HT</ion-label>
                <ion-note slot="end">100 €</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label>TVA (20%)</ion-label>
                <ion-note slot="end">20 €</ion-note>
              </ion-item>
  
              <ion-item>
                <ion-label><strong>TOTAL TTC</strong></ion-label>
                <ion-note slot="end"><strong>120 € / mois</strong></ion-note>
              </ion-item>
  
              <ion-item lines="none">
                <ion-checkbox slot="start" v-model="termsAccepted"></ion-checkbox>
                <ion-label>J'accepte les conditions générales</ion-label>
              </ion-item>
  
              <ion-button expand="full" class="custom-button" :disabled="!termsAccepted" @click="proceedToPayment">Paiement</ion-button>
              <ion-button expand="full" fill="clear" class="cancel-button" router-link="/">Annulation</ion-button>
            </ion-card-content>
          </ion-card>
  
          <div class="terms-info">
            <ion-text>
              Abonnement mensuel avec réengagement automatique sans durée d'engagement minimale.
              <a href="/terms">Voir les conditions générales de vente et d'utilisation</a>
            </ion-text>
          </div>
        </div>
      </ion-content>
    </ion-page>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonCard, IonCardHeader, IonCardTitle, IonCardContent, IonItem, IonLabel, IonNote, IonCheckbox, IonButton, IonButtons, IonBackButton, IonText } from '@ionic/vue';
  
  const termsAccepted = ref(false);
  
  const proceedToPayment = () => {
    console.log('Proceed to payment');
    // Logic for proceeding to payment
  };
  </script>
  
  <style scoped>
  .summary-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }
  
  .summary-card {
    max-width: 400px;
    width: 100%;
    background: #ffffffce;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
  
  .custom-button {
    --background: #15854b;
    --border-radius: 20px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
    margin-top: 20px;
  }
  
  .custom-button:disabled {
    opacity: 0.5;
  }
  
  .custom-button:hover {
    --background: #0f6d3b;
  }
  
  .cancel-button {
    color: #f53d3d;
  }
  
  .terms-info {
    text-align: center;
    margin-top: 20px;
  }
  </style>
  