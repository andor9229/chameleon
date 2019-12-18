# Services

---

- [AdsConnector](#section-1)

<a name="section-1"></a>
## GoogleAdsService

    La classe GoogleAdsServices ha la responsabilità di collegarsi al nostro account GoogleAds
    e di recuperare i report richiesti. 
    
    Il suo costruttore accetta 2 parametri:
        - clientCustomerId
        - during
        
    Il clientCustomerId è l'id dell'account GoogleAds in nostro possesso.
    During è il range di date per la quale vogliamo richiedere un report,
    è di tipo Array e usa il seguente formato: YYYY-MM-DD.
    
    Metodi:
        - getAdgroupPerformanceReport
        - getAccountPerformanceReport
