#include <iostream>
#include <string.h>
#include <math.h>
#include <vector>
#include <cstdlib>

using namespace std;

int main(int argc, char* argv[]) {
    int l = atoi(argv[1]);
    //cout << "Insert number of cryptograms: ";
    //cin >> l;
    //getline(cin, l);

    string* c = new string[l];

    int maxlen = 0;

    for(int i = 0; i < l; i++) {
        cout << "Insert cryptogram #" << i << ": ";
        //cin >> c[i];
        getline(cin, c[i]);
        if(c[i].length() > maxlen) maxlen = c[i].length();
    }

    int d = (maxlen) / 9;
    int A[l][d];
    for(int i = 0; i < l; i++){
        for(int j = 0; j < d; j++){
            A[i][j] = 0;
        }
    }

    int b[8];
    for(int i = 0; i < l - 1; i++){
        for(int j = i + 1; j < l; j++){
            int len = (min(c[i].length(), c[j].length())) / 9;
            for(int k = 0; k < len; k += 9){
                for(int bit = 0; bit < 8; bit++){
                    if(c[i][k + bit] == c[j][k + bit]){
                        b[bit] = 0;
                    } else {
                        b[bit] = 1;
                    }
                }
                if(b[0] == 0 && b[1] == 1){
                    A[i][k / 9]++;
                    A[j][k / 9]++;
                }
            }
        }
    }

    int lm1 = 0;
    int lm2 = 0;
    int k[d][8];

    for(int i = 0; i < d; i++){
        for(int j = 0; j < l; j++){
            if(A[j][i] > A[lm1][i]){
                lm2 = lm1;
                lm1 = j;
            }
        }
        for(int bit = 0; bit < 8; bit++){
            if(k[lm1][bit] == c[lm2][bit]){
                b[bit] = 0;
            } else {
                b[bit] = 1;
            }
        }
    }

    for(int i = 0; i < d; i++){
        for(int bit = 0; bit < 8; bit++){
            if(i == 2){
                if(k[i][bit] == 1){
                    b[bit] = 0;
                } else {
                    b[bit] = 1;
                }
            } else {
                if(k[i][bit] == 0){
                    b[bit] = 0;
                } else {
                    b[bit] = 1;
                }
            }
        }
    }

    cout << "Message to decipher: ";
    string msg;
    //cin >> msg;
    getline(cin, msg);

    for(int i = 0; i < (msg.length()) / 9; i++){
        for(int bit = 0; bit < 8; bit++){
            if(k[i][bit] == msg[i * 9 + bit]){
                b[bit] = 0;
            } else {
                b[bit] = 1;
            }
        }
        int multiplier = 1;
        int res = 0;
        for (i = 7; i >= 0; --i ){
            res += (multiplier * b[i]);
            multiplier *= 2;
        }
        char cs = res + '0';
        cout << cs;

    }



    return 0;
}
