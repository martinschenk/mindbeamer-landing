    <script>
        // Eigenständiges Notification-System ohne externe Abhängigkeiten
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisiere das eigenständige Notification-System
            console.log('MindBeamer: Benachrichtigungssystem wird initialisiert');
            
            // Globales Notification-Objekt definieren
            window.notifications = {
                success: function(message, title) {
                    return this.show(message, title || 'Erfolg', 'success');
                },
                error: function(message, title) {
                    return this.show(message, title || 'Fehler', 'error');
                },
                info: function(message, title) {
                    return this.show(message, title || 'Information', 'info');
                },
                warning: function(message, title) {
                    return this.show(message, title || 'Warnung', 'warning');
                },
                show: function(message, title, type) {
                    const container = document.getElementById('notifications');
                    if (!container) return false;
                    
                    const notification = document.createElement('div');
                    const bgColor = type === 'success' ? '#10B981' : 
                                  type === 'error' ? '#EF4444' : 
                                  type === 'warning' ? '#F59E0B' : '#3B82F6';
                    
                    notification.className = 'notification fixed right-4 top-4 z-50 max-w-md rounded-lg p-4 shadow-lg';
                    notification.style.backgroundColor = bgColor;
                    notification.style.color = '#ffffff';
                    notification.style.transition = 'all 0.3s ease';
                    
                    notification.innerHTML = `
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    ${type === 'success' 
                                        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                                        : type === 'error'
                                            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                                            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'}
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium">${title || ''}</p>
                                <p class="mt-1 text-sm">${message}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button class="inline-flex text-white hover:text-gray-200">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(notification);
                    
                    // Schließen-Button-Eventlistener
                    const closeButton = notification.querySelector('button');
                    closeButton.addEventListener('click', function() {
                        notification.style.opacity = '0';
                        notification.style.transform = 'translateY(-20px)';
                        setTimeout(() => {
                            notification.remove();
                        }, 300);
                    });
                    
                    // Auto-close nach 5 Sekunden
                    setTimeout(() => {
                        notification.style.opacity = '0';
                        notification.style.transform = 'translateY(-20px)';
                        setTimeout(() => {
                            notification.remove();
                        }, 300);
                    }, 5000);
                    
                    return true;
                }
            };
            
            // Abwärtskompatibilität für bisherigen Code mit Notification-API
            window.Notification = {
                make: function() {
                    let notificationObj = {
                            _title: '',
                            _body: '',
                            _status: 'info',
                            title: function(title) {
                                this._title = title;
                                return this;
                            },
                            body: function(body) {
                                this._body = body;
                                return this;
                            },
                            success: function() {
                                this._status = 'success';
                                return this;
                            },
                            danger: function() {
                                this._status = 'danger';
                                return this;
                            },
                            warning: function() {
                                this._status = 'warning';
                                return this;
                            },
                            info: function() {
                                this._status = 'info';
                                return this;
                            },
                            send: function() {
                                // Create a notification element
                                const notificationElement = document.createElement('div');
                                notificationElement.className = `notification notification-${this._status} fixed right-4 top-4 z-50 max-w-md rounded-lg p-4 shadow-lg transition-all duration-300 transform translate-y-0 opacity-100`;
                                notificationElement.style.backgroundColor = this._status === 'success' ? '#10B981' : 
                                                                           this._status === 'danger' ? '#EF4444' : 
                                                                           this._status === 'warning' ? '#F59E0B' : '#3B82F6';
                                notificationElement.style.color = 'white';
                                
                                // Add title and body
                                notificationElement.innerHTML = `
                                    <div class="flex items-start">
                                        <div class="shrink-0">
                                            ${this._status === 'success' ? 
                                                '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' : 
                                                this._status === 'danger' ? 
                                                '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                                                '<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'}
                                        </div>
                                        <div class="ml-3 w-0 flex-1 pt-0.5">
                                            <p class="text-sm font-medium">${this._title}</p>
                                            ${this._body ? `<p class="mt-1 text-sm">${this._body}</p>` : ''}
                                        </div>
                                        <div class="ml-4 flex shrink-0">
                                            <button class="inline-flex text-white hover:text-gray-200" onclick="this.parentElement.parentElement.parentElement.remove()">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                `;
                                
                                document.body.appendChild(notificationElement);
                                
                                // Auto-remove after 5 seconds
                                setTimeout(() => {
                                    notificationElement.style.opacity = '0';
                                    notificationElement.style.transform = 'translateY(-20px)';
                                    setTimeout(() => {
                                        notificationElement.remove();
                                    }, 300);
                                }, 5000);
                            }
                        };
                        
                        return notification;
                    }
                };
            }
        });
    </script>
