<script src='https://157.230.192.68:8000/external_api.js' async></script>

<div class="content-wrapper bg-white ">
    <div class="mx-4">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 mt-4">
                        <h1>Selamat Datang <?php echo ucfirst($user->first_name) . ' ' . ucfirst($user->last_name); ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-sm card-default my-shadow mb-4 w-100">
                        <div class="card-header ">

                            <h6 class="card-title mt-2 ">Video Conference</h6>
                            <!-- <div class="card-tools">
                        <button type="button" onclick="refreshPage()" class="btn btn-sm btn-default">
                            <i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ml-1">Reload</span>
                        </button>
                    </div> -->
                        </div>
                        <div class="card-body">
                            <div class="col-12">

                                <div id="jaas-container" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<style>
    #jaas-container {
        height: 500px;
        /* Set the desired height */
        width: 100%;
        /* Set the desired width */
    }
</style>
<script type="text/javascript">
    window.onload = () => {
        const api = new JitsiMeetExternalAPI("157.230.192.68:8000", {
            roomName: "<?php echo $kelas ? $kelas : 'test' ?>",
            parentNode: document.querySelector('#jaas-container'),
            userInfo: {
                email: '<?php echo $user->email; ?>',
                displayName: '<?php echo ucfirst($user->first_name) . ' ' . ucfirst($user->last_name); ?>',
                role: '<?php echo $role ? "moderator" : "participant"; ?>'
            }
        });

        api.addEventListener('videoConferenceJoined', (event) => {
            api.executeCommand('displayName', '<?php echo ($role ? "Guru_" : "Siswa_") . ucfirst($user->first_name) . ' ' . ucfirst($user->last_name); ?>');
            api.getRoomsInfo().then(rooms => {
                console.log(rooms.participants)
            });
        });

        // api.executeCommand('grantModerator',
        //     participantID: string
        // );
    }
</script>