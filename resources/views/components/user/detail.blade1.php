<div class="d-flex align-items-center mt-2">
                              <button class="btn btn-primary me-2" onclick="Export2Word('page-content', 'word-content.docx');">ទាញយកជា WORD<i class="bx bx-download mx-2"></i></button>
                              <button class="btn btn-primary me-2" onclick="printContent()">បោះពុម្ព <i class="bx bx-print"></i></button>
                            </div>

                            <script>
                              function printContent() {
                                // Get the content of the div to print
                                var content = document.getElementById('page-content').innerHTML;

                                // Create a new window with the content
                                var
                                  printWindow = window.open('none', '_blank');
                                printWindow.document.open();
                                // printWindow.document.write('<!DOCTYPE html><html><head><title></title></head><body>');
                                printWindow.document.write(content);
                                // printWindow.document.write('</body></html>');
                                printWindow.document.close();

                                // Print the window
                                printWindow.print();
                              }
                            </script>


                            <div id="page-content" hidden>
                              <div class="page-container hidden-on-narrow">
                                <div class="pdf-page size-a4">
                                  <div class="pdf-header">
                                    <center class="invoice-number" style="font-family: khmer mef2;color: #2F5496;">ព្រះរាជាណាចក្រកម្ពុជា<br>
                                      ជាតិ សាសនា ព្រះមហាក្សត្រ
                                    </center>
                                  </div>
                                  <div class="from">
                                    <div class="for" style="font-family: khmer mef2; font-size:14px; position: relative;
                                        color: #2F5496;">
                                      <span class="company-logo">
                                        <img src="{{ asset('images/logo2.png') }}" style="width: 100px;padding-left: 55px" />
                                      </span>
                                      <p>
                                        អាជ្ញាធរសេវាហិរញ្ញវត្ថុមិនមែនធនាគារ</p>
                                      <p style="text-indent: 50px; top: 0;">អង្គភាពសវនកម្មផ្ទៃក្នុង</p>
                                      
                                      <span class="company-logo">
                                        <img src="{{ asset('images/logo2.png') }}" style="width: 100px;padding-right: 55px" />
                                      </span>  
                                    

                                    </div>
                                   
                                    <center style="text-align: center; font-family: khmer mef2;">
                                      សូមគោរពជូន<br>
                                      លោកប្រធាននាយកដ្ឋាន
                                    </center>
                                    <p style="font-family: khmer mef1; font-size:14px; text-align: justify"><b style="font-family: khmer mef2">កម្មវត្ថុ៖</b> សំណើសុំច្បាប់ឈប់សម្រាកចំនួន។</p>
                                    <p style="font-family: khmer mef1; font-size:14px; text-align: justify">
                                      <b style="font-family: khmer mef2">មូលហេតុ៖</b>។
                                    </p>
                                    <p style="font-family: khmer mef1; font-size:14px; text-align:justify; text-indent: 50px;">
                                    តបតាមកម្មវត្ថុខាងលើ ខ្ញុំសូមគោរពជម្រាបជូន លោកប្រធាននាយកដ្ឋាន មេត្តាជ្រាបដ៏ខ្ពង់ខ្ពស់ថា៖ខ្ញុំបាទ/ នាងខ្ញុំឈ្មោះ  កើតថ្ងៃទី  ដូចមូលហេតុ និងកាលបរិច្ឆេទក្នុងកម្មវត្ថុខាងលើ។
                                    </p>
                                    <p style="font-family: khmer mef1; font-size:14px; text-align:justify; text-indent: 50px;">
                                      សេចក្តីដូចបានជម្រាបជូនខាងលើ សូម <b>លោកប្រធាននាយកដ្ឋាន</b> មេត្តាពិនិត្យ និងសម្រេចអនុញ្ញាតច្បាប់ដោយក្តីអនុគ្រោះ។
                                    </p>
                                    <p style="font-family: khmer mef1; font-size:14px; text-align:justify; text-indent: 50px;">
                                      សូម <b>លោកប្រធាននាយកដ្ឋាន</b> មេត្តាទទួលនូវការគោរពដ៏ខ្ពង់ខ្ពស់អំពីខ្ញុំ
                                    </p>
                                  </div>
                                  <div class="table-responsive-xl">
                                    <table class="table" style="width: 100%; text-align:center;">
                                      <thead>
                                        <th style="font-size: 14px;font-family: khmer mef1">អនុប្រធានការិយាល័យ</th>
                                        <th style="font-size: 14px;font-family: khmer mef1;">ប្រធានការិយាល័យ</th>
                                        <th style="font-size: 14px;font-family: khmer mef1;">អនុប្រធាននាយកដ្ឋាន</th>
                                        <th style="font-size: 14px;font-family: khmer mef1;">ប្រធាននាយកដ្ឋាន</th>
                                        <th style="font-size: 14px;font-family: khmer mef1;">អនុប្រធានអង្គភាព</th>
                                        <th style="font-size: 14px;font-family: khmer mef1;">ប្រធានអង្គភាព</th>
                                      </thead>
                                      <tbody>
                                        <td style="font-family: khmer mef1; font-size:12px; text-align: center">
                                         
                                        </td>
                                        <td style="font-family: khmer mef1; font-size:12px; text-align: center;">
                                         
                                        </td>
                                        <td style="font-family: khmer mef1; font-size:12px; text-align: center;">
                                         
                                        </td>
                                        <td style="font-family: khmer mef1; font-size:12px; text-align: center;">
                                         
                                        </td>
                                        <td style="font-family: khmer mef1; font-size:12px; text-align: center;">
                                      
                                        </td>
                                        <td style="font-family: khmer mef1; font-size:12px; text-align: center;">
                                         
                                        </td>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>