<?php
/**
 * Fast B2B Quotation & Enquiry Modal - PACTIVA ENERGY
 * High-Precision 2-Column SaaS & OEM Engineering RFQ (Matching Finexa-Style Modern UI)
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$wa_general_url = function_exists( 'pactiva_build_whatsapp_general_url' ) 
    ? pactiva_build_whatsapp_general_url( 'Direct RFQ inquiry from website quotation desk' )
    : 'https://wa.me/919818280807';
?>
<div id="pactiva-enquiry-modal" class="fixed inset-0 flex items-center justify-center p-3 sm:p-6 hidden transition-opacity duration-300 overflow-y-auto" style="z-index: 9999999 !important;">
    <!-- Backdrop with blur -->
    <div id="pactiva-modal-backdrop" class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity" style="z-index: 1;"></div>

    <style>
        /* ==========================================================================
           Bespoke Finexa-Grade SaaS Modal CSS
           ========================================================================== */
        #pactiva-enquiry-modal .modal-card {
            background: #ffffff !important;
            border-radius: 24px !important;
            box-shadow: 0 35px 90px -15px rgba(15, 23, 42, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
            max-width: 900px !important;
            width: 100% !important;
            margin: auto !important;
        }

        #pactiva-enquiry-modal .form-panel {
            background: #F8FAFC !important;
            border: 1px solid #EEF2F6 !important;
            border-radius: 20px !important;
            padding: 28px !important;
        }

        @media (max-width: 640px) {
            #pactiva-enquiry-modal .form-panel {
                padding: 18px !important;
            }
        }

        #pactiva-enquiry-modal .field-label {
            display: block !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            color: #1E293B !important;
            margin-bottom: 7px !important;
        }

        #pactiva-enquiry-modal .field-input,
        #pactiva-enquiry-modal .field-textarea {
            width: 100% !important;
            background: #FFFFFF !important;
            border: 1.5px solid #E2E8F0 !important;
            border-radius: 12px !important;
            color: #0F172A !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
            padding: 0 16px !important;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02) !important;
            outline: none !important;
            box-sizing: border-box !important;
        }

        #pactiva-enquiry-modal .field-input {
            height: 46px !important;
        }

        #pactiva-enquiry-modal .field-textarea {
            min-height: 105px !important;
            padding: 12px 16px !important;
            resize: vertical !important;
            line-height: 1.5 !important;
        }

        #pactiva-enquiry-modal .field-input:focus,
        #pactiva-enquiry-modal .field-textarea:focus {
            border-color: #FF8A00 !important;
            box-shadow: 0 0 0 4px rgba(255, 138, 0, 0.14) !important;
            background: #FFFFFF !important;
        }

        #pactiva-enquiry-modal .field-input::placeholder,
        #pactiva-enquiry-modal .field-textarea::placeholder {
            color: #94A3B8 !important;
            font-weight: 400 !important;
        }

        #pactiva-enquiry-modal .btn-submit-modal {
            width: 100% !important;
            height: 48px !important;
            background: linear-gradient(135deg, #FF8A00 0%, #EA580C 100%) !important;
            color: #ffffff !important;
            font-size: 14.5px !important;
            font-weight: 800 !important;
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 4px 16px rgba(255, 138, 0, 0.28) !important;
            cursor: pointer !important;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
        }

        #pactiva-enquiry-modal .btn-submit-modal:hover {
            box-shadow: 0 8px 24px rgba(255, 138, 0, 0.42) !important;
            transform: translateY(-1.5px) !important;
        }

        #pactiva-enquiry-modal .btn-submit-modal:active {
            transform: translateY(0) scale(0.99) !important;
        }

        #pactiva-enquiry-modal .pill-badge {
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            background: #F1F5F9 !important;
            color: #334155 !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            padding: 6px 14px !important;
            border-radius: 9999px !important;
            width: fit-content !important;
        }

        #pactiva-enquiry-modal .check-item {
            display: flex !important;
            align-items: flex-start !important;
            gap: 10px !important;
            font-size: 13px !important;
            color: #334155 !important;
            font-weight: 500 !important;
            line-height: 1.55 !important;
        }

        #pactiva-enquiry-modal .check-icon {
            color: #0F172A !important;
            font-weight: 900 !important;
            font-size: 15px !important;
            line-height: 1 !important;
            margin-top: 2px !important;
            flex-shrink: 0 !important;
        }
    </style>

    <!-- Modal Card (Ultra-Modern 2-Column SaaS Architecture) -->
    <div class="modal-card relative overflow-hidden max-h-[92vh] flex flex-col transform transition-all duration-300 scale-100" style="z-index: 2;">
        
        <!-- Floating Minimal Close Button (Top Right corner) -->
        <button type="button" 
                id="pactiva-modal-close" 
                class="absolute top-5 right-5 sm:top-6 sm:right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition-all z-20 cursor-pointer" 
                aria-label="<?php esc_attr_e( 'Close modal', 'pactiva-energy' ); ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Main 2-Column Body Container -->
        <div class="overflow-y-auto p-5 sm:p-8 lg:p-9 flex-1">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-7 items-stretch">
                
                <!-- Left Column: Soft Rounded Form Panel (7 cols on desktop) -->
                <div class="md:col-span-7 form-panel flex flex-col justify-between">
                    <div>
                        <!-- Active Product Prefill Pill -->
                        <div class="mb-4 inline-flex items-center gap-2 px-3 py-1 bg-white rounded-full border border-slate-200/90 shadow-2xs max-w-full">
                            <span class="w-2 h-2 rounded-full bg-brand-orange animate-pulse shrink-0"></span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider shrink-0"><?php esc_html_e( 'Quotation For:', 'pactiva-energy' ); ?></span>
                            <span id="modal-product-title" class="text-xs font-mono font-bold text-slate-800 truncate">
                                General Bulk Quotation [SKU: BULK-RFQ]
                            </span>
                        </div>

                        <!-- Status Alert Box -->
                        <div id="pactiva-form-status" class="hidden p-3.5 mb-4 rounded-xl text-xs font-semibold transition-all duration-300"></div>

                        <!-- Quotation Form -->
                        <form id="pactiva-quote-form" class="space-y-3.5">
                            <!-- Honeypot anti-spam -->
                            <div class="hidden" aria-hidden="true">
                                <input type="text" name="pactiva_hp_website" tabindex="-1" autocomplete="off">
                            </div>

                            <!-- Hidden Prefills -->
                            <input type="hidden" name="product_name" id="modal-field-product" value="">
                            <input type="hidden" name="product_sku" id="modal-field-sku" value="">
                            <input type="hidden" name="name" id="modal-full-name" value="">

                            <!-- Row 1: First Name & Last Name (2 equal columns) -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="field-label" for="modal-first-name">
                                        <?php esc_html_e( 'First Name', 'pactiva-energy' ); ?> <span class="text-brand-orange">*</span>
                                    </label>
                                    <input type="text" 
                                           id="modal-first-name" 
                                           required 
                                           class="field-input" 
                                           placeholder="<?php esc_attr_e( 'First Name', 'pactiva-energy' ); ?>">
                                </div>
                                <div>
                                    <label class="field-label" for="modal-last-name">
                                        <?php esc_html_e( 'Last Name', 'pactiva-energy' ); ?>
                                    </label>
                                    <input type="text" 
                                           id="modal-last-name" 
                                           class="field-input" 
                                           placeholder="<?php esc_attr_e( 'Last Name', 'pactiva-energy' ); ?>">
                                </div>
                            </div>

                            <!-- Row 2: Email -->
                            <div>
                                <label class="field-label">
                                    <?php esc_html_e( 'Email', 'pactiva-energy' ); ?> <span class="text-brand-orange">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       required 
                                       class="field-input" 
                                       placeholder="<?php esc_attr_e( 'Enter Your Email..', 'pactiva-energy' ); ?>">
                            </div>

                            <!-- Row 3: Phone Number -->
                            <div>
                                <label class="field-label">
                                    <?php esc_html_e( 'Phone Number', 'pactiva-energy' ); ?> <span class="text-brand-orange">*</span>
                                </label>
                                <input type="tel" 
                                       name="phone" 
                                       required 
                                       class="field-input" 
                                       placeholder="<?php esc_attr_e( 'Enter Your Number..', 'pactiva-energy' ); ?>">
                            </div>

                            <!-- Row 4: Company Name & Quantity -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="field-label">
                                        <?php esc_html_e( 'Company Name', 'pactiva-energy' ); ?>
                                    </label>
                                    <input type="text" 
                                           name="company" 
                                           class="field-input" 
                                           placeholder="<?php esc_attr_e( 'e.g. EV Tech Pvt Ltd', 'pactiva-energy' ); ?>">
                                </div>
                                <div>
                                    <label class="field-label">
                                        <?php esc_html_e( 'Estimated Quantity', 'pactiva-energy' ); ?>
                                    </label>
                                    <input type="number" 
                                           name="quantity" 
                                           min="1" 
                                           value="10" 
                                           class="field-input font-mono font-bold" 
                                           placeholder="10">
                                </div>
                            </div>

                            <!-- Row 5: Message -->
                            <div>
                                <label class="field-label">
                                    <?php esc_html_e( 'Message', 'pactiva-energy' ); ?>
                                </label>
                                <textarea name="message" 
                                          rows="3" 
                                          class="field-textarea" 
                                          placeholder="<?php esc_attr_e( 'Type your message, cell voltage, nominal capacity, discharge C-rate, delivery pincode...', 'pactiva-energy' ); ?>"></textarea>
                            </div>

                            <!-- Submit Button (Pill Gradient Button) -->
                            <div class="pt-2">
                                <button type="submit" class="btn-submit-modal">
                                    <span><?php esc_html_e( 'Send Message', 'pactiva-energy' ); ?></span>
                                </button>
                                
                                <p class="text-[11.5px] text-slate-400 text-center leading-relaxed mt-3">
                                    <?php esc_html_e( "By submitting this form, you agree to PACTIVA's Privacy Policy and consent to be contacted about your inquiry via email or phone. You can unsubscribe anytime.", 'pactiva-energy' ); ?>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Talk to our team & Value Proposition (5 cols on desktop) -->
                <div class="md:col-span-5 flex flex-col justify-between pt-1 pb-1">
                    <div>
                        <!-- Pill Badge -->
                        <div class="pill-badge mb-3">
                            <span><?php esc_html_e( 'Talk to our team', 'pactiva-energy' ); ?></span>
                        </div>

                        <!-- Big Bold Modern Heading (Exactly like reference) -->
                        <h2 class="text-2xl sm:text-3xl font-black font-heading text-slate-900 tracking-tight leading-[1.2] mb-3">
                            <?php esc_html_e( "Let's Build Smarter Energy Together", 'pactiva-energy' ); ?>
                        </h2>

                        <!-- Descriptive Subtitle -->
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6">
                            <?php esc_html_e( "See how PACTIVA's custom LiFePO4 battery packs, Smart BMS architecture, and tier-1 cell engineering power your electric vehicles and industrial storage systems.", 'pactiva-energy' ); ?>
                        </p>

                        <!-- Checklist Bullet Points with checkmarks -->
                        <div class="space-y-3.5 mb-8">
                            <div class="check-item">
                                <span class="check-icon">&#10003;</span>
                                <span><?php esc_html_e( 'Guided walkthrough of cell chemistry, custom voltage, and thermal pack architecture', 'pactiva-energy' ); ?></span>
                            </div>
                            <div class="check-item">
                                <span class="check-icon">&#10003;</span>
                                <span><?php esc_html_e( 'Smart BMS integration (CANbus, RS485, Bluetooth telemetry & active balancing)', 'pactiva-energy' ); ?></span>
                            </div>
                            <div class="check-item">
                                <span class="check-icon">&#10003;</span>
                                <span><?php esc_html_e( 'Review security architecture, BIS R-Number certification, and factory dispatch workflows', 'pactiva-energy' ); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom: Trusted By Section -->
                    <div class="pt-6 border-t border-slate-100">
                        <div class="text-[11px] font-extrabold uppercase tracking-widest text-slate-400 mb-3">
                            <?php esc_html_e( 'TRUSTED BY & CERTIFIED', 'pactiva-energy' ); ?>
                        </div>

                        <!-- Modern Minimalist Monochromatic Badges -->
                        <div class="grid grid-cols-3 gap-2.5 text-center">
                            <div class="py-2 px-1 bg-slate-50 rounded-xl border border-slate-100 text-[11px] font-bold text-slate-700">
                                BIS Certified
                            </div>
                            <div class="py-2 px-1 bg-slate-50 rounded-xl border border-slate-100 text-[11px] font-bold text-slate-700">
                                ISO 9001:2015
                            </div>
                            <div class="py-2 px-1 bg-slate-50 rounded-xl border border-slate-100 text-[11px] font-bold text-slate-700">
                                CE & RoHS
                            </div>
                            <div class="py-2 px-1 bg-slate-50 rounded-xl border border-slate-100 text-[11px] font-bold text-slate-700">
                                256-bit SSL
                            </div>
                            <div class="py-2 px-1 bg-slate-50 rounded-xl border border-slate-100 text-[11px] font-bold text-slate-700">
                                Tier-1 OEM
                            </div>
                            <div class="py-2 px-1 bg-slate-50 rounded-xl border border-slate-100 text-[11px] font-bold text-slate-700">
                                Pan-India
                            </div>
                        </div>

                        <!-- Instant WhatsApp Option -->
                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <a id="modal-whatsapp-link" 
                               href="<?php echo esc_url( $wa_general_url ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="inline-flex items-center gap-2 text-xs font-bold text-[#25D366] hover:text-[#1ebe5b] transition-colors">
                                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span><?php esc_html_e( 'Connect on WhatsApp with Engineering Team &rarr;', 'pactiva-energy' ); ?></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
